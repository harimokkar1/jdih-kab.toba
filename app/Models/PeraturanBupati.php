<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanBupati extends Model
{
    use HasFactory;

    protected $table = 'peraturan_bupatis';

    protected $fillable = [
        'tipe_dokumen',
        'jenis',
        'judul',
        'teu_badan',
        'tanggal_upload',
        'nomor_peraturan',
        'jenis_peraturan',
        'singkatan',
        'tempat_penetapan',
        'tahun',
        'tanggal_penetapan',
        'tanggal_pengundangan',
        'sumber',
        'subjek',
        'bahasa',
        'lokasi',
        'bidang_hukum',
        'abstrak',
        'english_version',
        'braille',
        'alih_suara',
        'file_dokumen',
        'status',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
        'tanggal_penetapan' => 'date',
        'tanggal_pengundangan' => 'date',
    ];
}