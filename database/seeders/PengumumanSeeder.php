<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Jalankan seeder Pengumuman Resmi Pemerintah Kabupaten Toba.
     */
    public function run(): void
    {
        Pengumuman::truncate();

        $announcements = [
            [
                'judul' => 'Uji Publik Rancangan Peraturan Daerah tentang Pengelolaan Pariwisata Berkelanjutan Kawasan Danau Toba',
                'isi' => 'Diberitahukan kepada seluruh masyarakat Kabupaten Toba, akademisi, asosiasi kepariwisataan, dan pemangku kepentingan bahwa Pemerintah Kabupaten Toba membuka masa Uji Publik terhadap Naskah Akademik dan Draf Ranperda Pengelolaan Pariwisata Berkelanjutan. Masukan tertulis dapat disampaikan langsung ke Bagian Hukum Setdakab Toba atau diunggah melalui formulir aspirasi daring portal JDIH paling lambat 14 hari kerja sejak pengumuman ini diterbitkan.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(1),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'judul' => 'Jadwal Pelayanan Konsultasi Regulasi dan Pengesahan Peraturan Desa (Perdes) Semester II',
                'isi' => 'Bagian Hukum Sekretariat Daerah Kabupaten Toba mengumumkan jadwal fasilitasi dan evaluasi draf Peraturan Desa serta Peraturan Kepala Desa untuk semester berjalan. Seluruh Kepala Desa dan Tim Penyusun Produk Hukum Desa diimbau membawa berkas rancangan, notula musyawarah desa, serta lembar kendali telaah camat sesuai jadwal zonasi kecamatan yang telah ditentukan.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(4),
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'judul' => 'Konsultasi Publik Rancangan Peraturan Bupati tentang Standar Biaya Masukan Pemkab Toba Tahun 2025',
                'isi' => 'Dalam rangka penyusunan Rencana Kerja Pemerintah Daerah (RKPD) dan RKA Perangkat Daerah Tahun Anggaran 2025, Bagian Hukum bersama Badan Pengelola Keuangan dan Pendapatan Daerah (BPKPD) menyelenggarakan Konsultasi Publik Standar Biaya Masukan (SBM). Draf regulasi memuat batas tertinggi estimasi biaya pelaksanaan program kedinasan secara terukur dan transparan.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(9),
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9),
            ],
            [
                'judul' => 'Pemberitahuan Pemeliharaan Rutin Server dan Sinkronisasi Basis Data JDIHN Nasional',
                'isi' => 'Disampaikan kepada seluruh pengguna layanan portal JDIH Kabupaten Toba bahwa akan dilaksanakan pemeliharaan sistem terencana (scheduled maintenance) dan penyelarasan endpoint REST API dengan server pusat BPHN Kementerian Hukum dan HAM RI pada akhir pekan ini. Layanan pencarian regulasi tetap dapat diakses normal secara bertahap.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(14),
                'created_at' => Carbon::now()->subDays(14),
                'updated_at' => Carbon::now()->subDays(14),
            ],
            [
                'judul' => 'Fasilitasi dan Verifikasi Yuridis Naskah Kerja Sama Daerah Bersama Badan Usaha dan Pihak Ketiga',
                'isi' => 'Seluruh Perangkat Daerah yang merencanakan penandatanganan Nota Kesepahaman (MoU) dan Perjanjian Kerja Sama (PKS) dengan lembaga non-pemerintah maupun badan usaha wajib mengajukan naskah telaah yuridis ke Bagian Hukum Setdakab Toba sekurang-kurangnya 10 (sepuluh) hari kerja sebelum tanggal penandatanganan naskah resmi.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(20),
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'judul' => 'Sosialisasi Penerapan Naskah Dinas Elektronik dan Tanda Tangan Digital Resmi Pemkab Toba',
                'isi' => 'Menindaklanjuti Peraturan Bupati Toba mengenai penyelenggaraan SPBE, seluruh penerbitan produk hukum surat edaran, instruksi, dan naskah dinas kedinasan internal telah resmi dilengkapi dengan Tanda Tangan Elektronik (TTE) tersertifikasi Balai Sertifikasi Elektronik (BSrE) BSSN guna menjamin keaslian dan integritas dokumen.',
                'file_pdf' => 'sample-pengumuman-toba.pdf',
                'tanggal_upload' => Carbon::today()->subDays(27),
                'created_at' => Carbon::now()->subDays(27),
                'updated_at' => Carbon::now()->subDays(27),
            ],
        ];

        foreach ($announcements as $item) {
            Pengumuman::create($item);
        }
    }
}

