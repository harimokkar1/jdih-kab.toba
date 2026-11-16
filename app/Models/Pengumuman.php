<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumumen';

    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'file_pdf',
        'tanggal_upload',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengumuman::class, 'kategori_id');
    }

    protected $casts = [
        'tanggal_upload' => 'date',
    ];
}