<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder akun pengguna sistem JDIH.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin JDIH',
                'email' => 'superadmin@jdih.tobakab.go.id',
                'password' => Hash::make('SuperAdmin123!'),
                'role' => 'super_admin',
            ],
            [
                'name' => 'Administrator JDIH',
                'email' => 'admin@jdih.tobakab.go.id',
                'password' => Hash::make('AdminToba2024!'),
                'role' => 'admin',
            ],
            [
                'name' => 'Operator & Petugas JDIH',
                'email' => 'petugas@jdih.tobakab.go.id',
                'password' => Hash::make('PetugasJDIH123!'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kepala Bagian Hukum',
                'email' => 'kabag-hukum@jdih.tobakab.go.id',
                'password' => Hash::make('KabagHukum123!'),
                'role' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
