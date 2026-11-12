<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Jalankan seeder Struktur Organisasi Tim Pengelola JDIH Kabupaten Toba.
     * Sesuai Perpres No. 33/2012 dan Permenkumham No. 8/2019.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        StrukturOrganisasi::truncate();
        Schema::enableForeignKeyConstraints();

        // LEVEL 1: Pembina, Pengarah, dan Penanggung Jawab Utama
        $pembina = StrukturOrganisasi::create([
            'nama' => 'Ir. Poltak Sitorus',
            'jabatan' => 'Pembina Utama JDIH (Bupati Toba)',
            'tingkat' => 1,
            'parent_id' => null,
            'foto' => null,
            'urutan' => 1,
        ]);

        $pengarah = StrukturOrganisasi::create([
            'nama' => 'Drs. Augus Sitorus',
            'jabatan' => 'Pengarah Kebijakan JDIH (Sekretaris Daerah Kabupaten Toba)',
            'tingkat' => 1,
            'parent_id' => $pembina->id,
            'foto' => null,
            'urutan' => 2,
        ]);

        $penanggungJawab = StrukturOrganisasi::create([
            'nama' => 'Eston D. Siregar, S.H., M.Hum.',
            'jabatan' => 'Penanggung Jawab Teknis & Operasional (Kepala Bagian Hukum Setdakab Toba)',
            'tingkat' => 1,
            'parent_id' => $pengarah->id,
            'foto' => null,
            'urutan' => 3,
        ]);

        // LEVEL 2: Koordinator & Sub Koordinator / Verifikator Hukum
        $subPUU = StrukturOrganisasi::create([
            'nama' => 'Marolop Simanjuntak, S.H., M.H.',
            'jabatan' => 'Sub Koordinator Perundang-Undangan Daerah',
            'tingkat' => 2,
            'parent_id' => $penanggungJawab->id,
            'foto' => null,
            'urutan' => 1,
        ]);

        $subJDIH = StrukturOrganisasi::create([
            'nama' => 'Sondang Nainggolan, S.H., M.Si.',
            'jabatan' => 'Sub Koordinator Dokumentasi dan Informasi Hukum (JDIH)',
            'tingkat' => 2,
            'parent_id' => $penanggungJawab->id,
            'foto' => null,
            'urutan' => 2,
        ]);

        $subBankum = StrukturOrganisasi::create([
            'nama' => 'Binsar Marpaung, S.H.',
            'jabatan' => 'Sub Koordinator Bantuan Hukum dan Hak Asasi Manusia',
            'tingkat' => 2,
            'parent_id' => $penanggungJawab->id,
            'foto' => null,
            'urutan' => 3,
        ]);

        // LEVEL 3: Tim Pelaksana, Operator, Analis, & Pengolah Data JDIH
        StrukturOrganisasi::create([
            'nama' => 'Rian Tampubolon, S.H.',
            'jabatan' => 'Perancang Peraturan Perundang-undangan Ahli Muda',
            'tingkat' => 3,
            'parent_id' => $subPUU->id,
            'foto' => null,
            'urutan' => 1,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Kristina Hutapea, S.H.',
            'jabatan' => 'Analis Kebijakan & Penelaah Naskah Hukum',
            'tingkat' => 3,
            'parent_id' => $subPUU->id,
            'foto' => null,
            'urutan' => 2,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Ronald Pardede, S.Kom.',
            'jabatan' => 'Pranata Komputer & Administrator Portal JDIHN',
            'tingkat' => 3,
            'parent_id' => $subJDIH->id,
            'foto' => null,
            'urutan' => 3,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Dewi Sartika Panjaitan, A.Md.',
            'jabatan' => 'Pengolah Data Dokumen & Arsiparis Regulasi',
            'tingkat' => 3,
            'parent_id' => $subJDIH->id,
            'foto' => null,
            'urutan' => 4,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'David Sibarani, S.H.',
            'jabatan' => 'Verifikator Naskah Hukum & Fasilitasi HAM',
            'tingkat' => 3,
            'parent_id' => $subBankum->id,
            'foto' => null,
            'urutan' => 5,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Hotmaida Sirait, S.Sos.',
            'jabatan' => 'Petugas Pelayanan Informasi & Konsultasi Publik JDIH',
            'tingkat' => 3,
            'parent_id' => $subJDIH->id,
            'foto' => null,
            'urutan' => 6,
        ]);
    }
}

