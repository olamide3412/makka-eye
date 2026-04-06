<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnums;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing users
        User::query()->delete();

        // Create the admin user
        User::create([
            'name' => 'Skynet Admin',
            'email' => 'admin@skynet.com',
            'password' => Hash::make('password'),
            'role' => RoleEnums::Administrator->value,
        ]);
    }
}
