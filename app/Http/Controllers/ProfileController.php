<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // 2MB max file size
                'dimensions:ratio=1/1', // Require 1:1 aspect ratio
                'dimensions:min_width=100', // Minimum width of 100 pixels
            ],
        ], [], ['avatar' => 'Profile Picture']);

        // Handle avatar update if needed
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $path = 'avatars/' . uniqid() . '.png'; // New avatar path

            Storage::disk('s3')->put($path, file_get_contents($avatarFile));

            // Delete the previous avatar if exists
            if ($user->avatar) {
                Storage::disk('s3')->delete($user->avatar);
            }

            $user->avatar = $path;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        $user->save();

        // Send a new email verification link if the email was updated
        if ($user->wasChanged('email')) {
            $user->email_verified_at = null; // Mark email as unverified
            $user->save();
            $user->sendEmailVerificationNotification();
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
