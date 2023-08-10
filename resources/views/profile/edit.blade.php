@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <!-- Display success message -->
                                @if (session('success'))
                                    <div class="alert alert-success mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- Display email verification status -->
                                @if (!$user->hasVerifiedEmail())
                                <div class="alert alert-warning mb-4">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif

                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }},
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                    </form>
                                </div>
                                @endif
                                <img src="{{ Storage::url($user->avatar) }}" alt="User Avatar" class="img-thumbnail img-fluid">
                            </div>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name) }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="avatar">Profile Picture</label><br>
                                <input type="file" name="avatar" id="avatar" class="form-control-file @error('avatar') is-invalid @enderror border"><br>
                                <small class="form-text text-muted">Upload a square image with an exact 1:1 aspect ratio and a maximum file size of 2MB.</small>
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
