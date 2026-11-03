<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'superadmin@jdih.tobakab.go.id',
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('SuperAdmin123!'),
                'role' => 'super_admin',
            ]
        );
    }
}