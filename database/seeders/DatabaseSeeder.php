<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seluruh seeder data sistem JDIH Kabupaten Toba.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JenisPeraturanSeeder::class,
            VisiMisiSeeder::class,
            StrukturOrganisasiSeeder::class,
            PeraturanSeeder::class,
            BeritaSeeder::class,
            PengumumanSeeder::class,
            VisitorSeeder::class,
        ]);
    }
}
