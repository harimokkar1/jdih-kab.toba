<?php

namespace Database\Seeders;

use App\Models\JenisPeraturan;
use App\Models\Peraturan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateLegacyProdukHukumSeeder extends Seeder
{
    public function run(): void
    {
        $mapping = [
            'peraturan_daerahs' => 'peraturan-daerah',
            'peraturan_bupatis' => 'peraturan-bupati',
            'keputusan_bupatis' => 'keputusan-bupati',
        ];

        foreach ($mapping as $table => $slug) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            $jenis = JenisPeraturan::where('slug', $slug)->first();
            if (!$jenis) {
                continue;
            }

            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                // Cek apakah sudah pernah dimigrasikan
                $exists = Peraturan::where('jenis_peraturan_id', $jenis->id)
                    ->where('judul', $row->judul)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // Normalisasi path file_dokumen
                $fileDokumen = $row->file_dokumen;
                if (!empty($fileDokumen) && !str_starts_with($fileDokumen, 'uploads/')) {
                    $fileDokumen = 'uploads/' . str_replace('_', '-', $slug) . '/' . basename($fileDokumen);
                }

                Peraturan::create([
                    'jenis_peraturan_id' => $jenis->id,
                    'tipe_dokumen' => $row->tipe_dokumen ?? 'Peraturan Perundang-undangan',
                    'judul' => $row->judul,
                    'nomor_peraturan' => $row->nomor_peraturan,
                    'tahun' => $row->tahun,
                    'singkatan' => $row->singkatan,
                    'teu_badan' => $row->teu_badan ?? 'Pemerintah Kabupaten Toba',
                    'tempat_penetapan' => $row->tempat_penetapan ?? 'Balige',
                    'tanggal_penetapan' => $row->tanggal_penetapan,
                    'tanggal_pengundangan' => $row->tanggal_pengundangan,
                    'tanggal_upload' => $row->tanggal_upload,
                    'sumber' => $row->sumber,
                    'subjek' => $row->subjek,
                    'bahasa' => $row->bahasa ?? 'Bahasa Indonesia',
                    'lokasi' => $row->lokasi ?? 'Bagian Hukum Setdakab Toba',
                    'bidang_hukum' => $row->bidang_hukum,
                    'abstrak' => $row->abstrak,
                    'status' => $row->status ?? 'BERLAKU',
                    'file_dokumen' => $fileDokumen ?? 'sample.pdf',
                    'english_version' => $row->english_version,
                    'braille' => $row->braille,
                    'alih_suara' => $row->alih_suara,
                    'created_at' => $row->created_at ?? now(),
                    'updated_at' => $row->updated_at ?? now(),
                ]);
            }
        }
    }
}
