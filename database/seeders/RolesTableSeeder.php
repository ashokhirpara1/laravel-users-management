<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);

        User::where('id', 1)->update(['role_id' => $adminRole->id]);
        User::where('id', 2)->update(['role_id' => $userRole->id]);
    }
}
