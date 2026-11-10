<?php

namespace Database\Seeders;

use App\Models\JenisPeraturan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JenisPeraturanSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Peraturan Daerah',
                'singkatan' => 'PERDA',
                'slug' => 'peraturan-daerah',
                'deskripsi' => 'Peraturan Daerah Kabupaten Toba yang ditetapkan oleh Bupati dengan persetujuan bersama DPRD.',
                'urutan' => 1,
            ],
            [
                'nama' => 'Peraturan Bupati',
                'singkatan' => 'PERBUP',
                'slug' => 'peraturan-bupati',
                'deskripsi' => 'Peraturan Bupati Toba sebagai aturan pelaksanaan dari Peraturan Daerah atau ketentuan peraturan perundang-undangan yang lebih tinggi.',
                'urutan' => 2,
            ],
            [
                'nama' => 'Keputusan Bupati',
                'singkatan' => 'KEPBUP',
                'slug' => 'keputusan-bupati',
                'deskripsi' => 'Keputusan Bupati Toba yang bersifat penetapan individual, konkrit, dan final dalam penyelenggaraan pemerintahan daerah.',
                'urutan' => 3,
            ],
            [
                'nama' => 'Instruksi Bupati',
                'singkatan' => 'INBUP',
                'slug' => 'instruksi-bupati',
                'deskripsi' => 'Petunjuk tertulis dari Bupati Toba kepada bawahan untuk melaksanakan tugas-tugas pemerintahan atau penanganan urusan tertentu.',
                'urutan' => 4,
            ],
            [
                'nama' => 'Surat Edaran',
                'singkatan' => 'SE',
                'slug' => 'surat-edaran',
                'deskripsi' => 'Naskah dinas pemberitahuan atau petunjuk pelaksanaan urusan pemerintahan bagi jajaran internal Pemkab Toba.',
                'urutan' => 5,
            ],
        ];

        foreach ($categories as $cat) {
            JenisPeraturan::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}

