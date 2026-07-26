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
        User::firstOrCreate([
            'name' => 'MSEHIBADAN Admin',
            'email' => 'admin@msehibadan.org',
            'password' => Hash::make('Admin@2026'),
            'role' => RoleEnums::Administrator->value,
        ]);

        User::firstOrCreate(
            ['email' => 'admin2@msehibadan.org'],
            [
                'name' => 'MSEHIBADAN Admin2',
                'password' => Hash::make('Admin@2026'),
                'role' => RoleEnums::Administrator->value,
            ]
        );

    }
}
