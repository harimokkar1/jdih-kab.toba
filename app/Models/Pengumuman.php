<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumumen';

    protected $fillable = [
        'judul',
        'isi',
        'file_pdf',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];
}