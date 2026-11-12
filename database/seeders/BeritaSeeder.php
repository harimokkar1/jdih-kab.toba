<?php

namespace Database\Seeders;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Jalankan seeder Berita Hukum dan Kegiatan Pemkab Toba.
     */
    public function run(): void
    {
        Berita::truncate();

        $news = [
            [
                'judul' => 'Harmonisasi dan Penyelarasan Ranperda Kabupaten Toba Bersama Kanwil Kemenkumham Sumut',
                'gambar' => 'berita-harmonisasi-perda.svg',
                'isi' => "Balige — Pemerintah Kabupaten Toba melalui Bagian Hukum Sekretariat Daerah menyelenggarakan rapat koordinasi harmonisasi, pembulatan, dan pemantapan konsepsi Rancangan Peraturan Daerah (Ranperda) bersama Kantor Wilayah Kementerian Hukum dan HAM Sumatera Utara bertempat di Ruang Rapat Kantor Bupati Toba.\n\nKegiatan ini merupakan implementasi nyata dari Undang-Undang Nomor 13 Tahun 2022 tentang Perubahan Kedua atas Undang-Undang Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-undangan. Harmonisasi ini bertujuan untuk memastikan setiap norma yang dimuat dalam Ranperda tidak bertentangan dengan peraturan perundang-undangan yang lebih tinggi, putusan pengadilan, maupun asas-asas pembentukan peraturan perundang-undangan yang baik.\n\nKepala Bagian Hukum Setdakab Toba menyampaikan bahwa sinkronisasi yuridis sejak tahap perancangan sangat krusial agar produk hukum yang dihasilkan memiliki landasan filosofis, sosiologis, dan yuridis yang kokoh serta memberikan kepastian hukum yang berkeadilan bagi seluruh masyarakat Kabupaten Toba.",
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'judul' => 'JDIH Kabupaten Toba Hadirkan Inovasi Layanan Ramah Disabilitas dan Mobile-Friendly',
                'gambar' => 'berita-inovasi-jdih.svg',
                'isi' => "Balige — Sebagai wujud komitmen keterbukaan informasi publik dan pelayanan prima yang inklusif, Bagian Hukum Sekretariat Daerah Kabupaten Toba resmi meluncurkan pembaruan sistem pada portal Jaringan Dokumentasi dan Informasi Hukum (JDIH).\n\nPembaruan ini mencakup integrasi fitur aksesibilitas bagi penyandang disabilitas, antara lain penyediaan naskah braille digital, layanan alih suara (audio narasi), penyesuaian kontras layar, serta kemudahan navigasi perangkat bergerak (mobile-first design). Dengan inovasi ini, setiap warga negara tanpa terkecuali dapat mengakses dokumen peraturan perundang-undangan daerah secara mandiri, transparan, dan mudah.\n\nLangkah inovatif ini sejalan dengan arahan Badan Pembinaan Hukum Nasional (BPHN) Kementerian Hukum dan HAM RI dalam memperluas cakupan literasi hukum digital ke seluruh lapisan masyarakat hingga pelosok desa di wilayah Toba.",
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'judul' => 'Bupati Toba Sampaikan Nota Pengantar Ranperda Rencana Tata Ruang Wilayah 2023-2043 di DPRD',
                'gambar' => 'berita-paripurna-dprd.svg',
                'isi' => "Balige — Bupati Toba secara resmi menyampaikan Nota Pengantar Rancangan Peraturan Daerah tentang Rencana Tata Ruang Wilayah (RTRW) Kabupaten Toba Tahun 2023-2043 dalam Rapat Paripurna Dewan Perwakilan Rakyat Daerah (DPRD) Kabupaten Toba.\n\nDalam pidato pengantarnya, Bupati menekankan bahwa Ranperda RTRW merupakan instrumen strategis dalam mengarahkan pemanfaatan ruang wilayah secara serasi, seimbang, dan berkelanjutan selama 20 tahun ke depan. Penataan ruang ini mengintegrasikan perlindungan kawasan resapan air dan kelestarian Danau Toba dengan percepatan pembangunan infrastruktur, pertanian modern, dan sentra ekonomi pariwisata super prioritas.\n\nDPRD Kabupaten Toba menyambut baik nota pengantar tersebut dan menyatakan komitmennya untuk segera membahas Ranperda bersama Tim Badan Pembentukan Peraturan Daerah (Bapemperda) dan Bagian Hukum Setdakab Toba secara komprehensif.",
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'judul' => 'Bagian Hukum Setdakab Gelar Bimtek Penyusunan Produk Hukum Desa Se-Kabupaten Toba',
                'gambar' => 'berita-bimtek-perdes.svg',
                'isi' => "Balige — Dalam rangka memperkuat tata kelola pemerintahan desa yang taat hukum, Bagian Hukum Sekretariat Daerah Kabupaten Toba menggelar Bimbingan Teknis (Bimtek) Teknik Penyusunan Produk Hukum Desa bagi para Kepala Desa, Sekretaris Desa, dan Ketua Badan Permusyawaratan Desa (BPD) se-Kabupaten Toba.\n\nBimtek ini difokuskan pada standarisasi format penyusunan Peraturan Desa (Perdes), Peraturan Kepala Desa (Perkades), dan Keputusan Kepala Desa agar sesuai dengan kaidah pembentukan peraturan perundang-undangan serta tidak memberatkan masyarakat melalui pungutan liar atau aturan yang bertentangan dengan regulasi di atasnya.\n\nNarasumber dari Tim Perancang Peraturan Perundang-undangan Ahli Bagian Hukum memberikan pembekalan teknis dan simulasi penyusunan naskah perdes secara langsung guna memastikan setiap desa mampu mandiri dalam menerbitkan regulasi yang berkualitas.",
                'created_at' => Carbon::now()->subDays(12),
                'updated_at' => Carbon::now()->subDays(12),
            ],
            [
                'judul' => 'JDIH Kabupaten Toba Raih Predikat Anggota Terintegrasi Nasional Terbaik dari BPHN Kemenkumham',
                'gambar' => 'berita-penghargaan-jdihn.svg',
                'isi' => "Jakarta — Jaringan Dokumentasi dan Informasi Hukum (JDIH) Pemerintah Kabupaten Toba berhasil meraih penghargaan nasional dari Kementerian Hukum dan HAM RI melalui Badan Pembinaan Hukum Nasional (BPHN) atas integrasi sistem dan pengelolaan dokumentasi hukum yang berkelanjutan.\n\nPenilaian didasarkan pada kelengkapan metadata regulasi daerah, kecepatan pemutakhiran produk hukum, ketersediaan naskah asli pindaian (PDF), penerapan standar keamanan data, dan tingkat keaktifan sinkronisasi API ke basis data nasional JDIHN.go.id.\n\nPemerintah Kabupaten Toba menyampaikan rasa terima kasih kepada seluruh pengelola JDIH dan jajaran perangkat daerah yang terus berkolaborasi mewujudkan keterbukaan informasi hukum demi terciptanya pemerintahan yang bersih dan akuntabel.",
                'created_at' => Carbon::now()->subDays(16),
                'updated_at' => Carbon::now()->subDays(16),
            ],
            [
                'judul' => 'Sosialisasi Peraturan Daerah tentang Pajak Daerah dan Retribusi Daerah Baru di Balige',
                'gambar' => 'berita-sosialisasi-pajak.svg',
                'isi' => "Balige — Badan Pendapatan Daerah bersama Bagian Hukum Setdakab Toba menggelar sosialisasi intensif pemberlakuan Peraturan Daerah tentang Pajak Daerah dan Retribusi Daerah (PDRD) yang disusun berdasarkan amanat Undang-Undang Nomor 1 Tahun 2022 tentang Hubungan Keuangan antara Pemerintah Pusat dan Pemerintahan Daerah (HKPD).\n\nSosialisasi dihadiri oleh para pelaku usaha perhotelan, restoran, penyedia jasa pariwisata, serta perwakilan asosiasi usaha di Kabupaten Toba. Dalam pemaparannya, tim pemateri menegaskan bahwa restrukturisasi tarif retribusi dan pajak daerah dirancang untuk menyederhanakan administrasi perpajakan sekaligus memberikan insentif fiskal bagi usaha mikro dan kecil.\n\nDokumen lengkap Perda PDRD beserta penjelasannya telah diunggah dan dapat diunduh secara bebas oleh publik melalui portal resmi JDIH Kabupaten Toba.",
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'judul' => 'Pemerintah Kabupaten Toba Tingkatkan Akses Bantuan Hukum Gratis Melalui Pos Bantuan Hukum',
                'gambar' => 'berita-layanan-posbakum.svg',
                'isi' => "Balige — Guna menjamin hak konstitusional setiap warga negara atas perlakuan yang sama di hadapan hukum, Sub Bagian Bantuan Hukum dan HAM Bagian Hukum Setdakab Toba meningkatkan kapasitas layanan konsultasi hukum dan pendampingan advokasi secara cuma-cuma (pro bono) bagi masyarakat kurang mampu.\n\nLayanan bantuan hukum ini bekerja sama dengan Organisasi Bantuan Hukum (OBH) yang terakreditasi oleh Kementerian Hukum dan HAM. Masyarakat dapat berkonsultasi mengenai permasalahan perdata, pertanahan, waris, perlindungan perempuan dan anak, maupun perkara hukum lainnya.\n\nFormulir permohonan bantuan hukum dan syarat administrasi kini juga telah terintegrasi secara digital pada menu Layanan Informasi Publik di situs JDIH Kabupaten Toba.",
                'created_at' => Carbon::now()->subDays(24),
                'updated_at' => Carbon::now()->subDays(24),
            ],
            [
                'judul' => 'Konsultasi Publik Raperda Pelestarian Lingkungan Hidup dan Ekosistem Danau Toba',
                'gambar' => 'berita-konsultasi-danau-toba.svg',
                'isi' => "Balige — Dinas Lingkungan Hidup bekerja sama dengan Bagian Hukum Setdakab Toba menggelar Forum Konsultasi Publik Rancangan Peraturan Daerah tentang Pelestarian dan Perlindungan Ekosistem Kawasan Danau Toba.\n\nForum ini melibatkan berbagai pemangku kepentingan, termasuk tokoh adat Lembaga Adat Dalihan Natolu (LADN), pegiat lingkungan, akademisi, pelaku usaha perikanan ramah lingkungan, dan generasi muda. Ranperda ini menitikberatkan pada pembatasan beban pencemaran air danau, penataan zona sempadan pantai, konservasi Daerah Aliran Sungai (DAS), serta perlindungan hutan tangkapan air.\n\nMasukan dan saran dari masyarakat luas akan dihimpun sebagai bahan penyempurnaan naskah akademik sebelum diajukan ke Dewan Perwakilan Rakyat Daerah untuk tahap pembahasan tingkat pertama.",
                'created_at' => Carbon::now()->subDays(28),
                'updated_at' => Carbon::now()->subDays(28),
            ],
        ];

        foreach ($news as $item) {
            Berita::create($item);
        }
    }
}
