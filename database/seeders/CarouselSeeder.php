<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Jalankan seeder Carousel Banner JDIH Kabupaten Toba.
     */
    public function run(): void
    {
        // Bersihkan data lama carousel
        Carousel::truncate();

        $slides = [
            [
                'image' => 'carousel-portal-resmi.svg',
                'title' => 'Portal Resmi JDIH Kabupaten Toba: Akses Cepat, Transparan, dan Terpercaya',
            ],
            [
                'image' => 'carousel-harmonisasi-jdihn.svg',
                'title' => 'Harmonisasi & Standarisasi Regulasi Daerah Terintegrasi Nasional BPHN',
            ],
            [
                'image' => 'carousel-layanan-inklusif.svg',
                'title' => 'Layanan Informasi Hukum Berkeadilan & Aksesibilitas Ramah Disabilitas',
            ],
        ];

        foreach ($slides as $slide) {
            Carousel::create($slide);
        }
    }
}

