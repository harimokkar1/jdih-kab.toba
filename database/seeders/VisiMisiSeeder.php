<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    /**
     * Jalankan seeder Visi & Misi Resmi Pemerintah Kabupaten Toba.
     */
    public function run(): void
    {
        $visi = 'Terwujudnya Kabupaten Toba yang Unggul, Berkarakter, Maju, dan Berkelanjutan.';

        $misi = "1. Mewujudkan tata kelola pemerintahan yang baik, bersih, transparan, akuntabel, dan berwibawa berbasis teknologi informasi (SPBE).\n"
              . "2. Meningkatkan pelayanan publik prima serta kepastian hukum yang berkeadilan, inklusif, dan humanis bagi seluruh lapisan masyarakat.\n"
              . "3. Mengembangkan perekonomian daerah berbasis pertanian, pariwisata bertaraf internasional di kawasan Danau Toba, dan penguatan UMKM lokal.\n"
              . "4. Meningkatkan kualitas sumber daya manusia yang berdaya saing tinggi, berbudi pekerti luhur berlandaskan kearifan lokal, cerdas, dan sehat.\n"
              . "5. Membangun infrastruktur wilayah yang terintegrasi, merata, berwawasan lingkungan hidup, dan berkelanjutan.";

        VisiMisi::updateOrCreate(
            ['id' => 1],
            [
                'visi' => $visi,
                'misi' => $misi,
            ]
        );
    }
}

