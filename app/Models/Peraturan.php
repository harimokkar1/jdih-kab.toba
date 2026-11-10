<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peraturan extends Model
{
    protected $table = 'peraturans';

    protected $fillable = [
        'jenis_peraturan_id',
        'tipe_dokumen',
        'judul',
        'nomor_peraturan',
        'tahun',
        'singkatan',
        'teu_badan',
        'tempat_penetapan',
        'tanggal_penetapan',
        'tanggal_pengundangan',
        'tanggal_upload',
        'sumber',
        'subjek',
        'bahasa',
        'lokasi',
        'bidang_hukum',
        'abstrak',
        'status',
        'file_dokumen',
        'english_version',
        'braille',
        'alih_suara',
        'view_count',
        'download_count',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'tanggal_penetapan' => 'date',
        'tanggal_pengundangan' => 'date',
        'tanggal_upload' => 'date',
        'view_count' => 'integer',
        'download_count' => 'integer',
    ];

    public function jenisPeraturan(): BelongsTo
    {
        return $this->belongsTo(JenisPeraturan::class, 'jenis_peraturan_id');
    }

    /**
     * Scope filter pencarian fleksibel
     */
    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
                ->orWhere('nomor_peraturan', 'like', "%{$keyword}%")
                ->orWhere('tahun', 'like', "%{$keyword}%")
                ->orWhere('subjek', 'like', "%{$keyword}%")
                ->orWhere('teu_badan', 'like', "%{$keyword}%")
                ->orWhere('bidang_hukum', 'like', "%{$keyword}%");
        });
    }

    /**
     * Scope hanya produk hukum yang berlaku
     */
    public function scopeBerlaku(Builder $query): Builder
    {
        return $query->where('status', 'BERLAKU');
    }

    /**
     * Helper URL file dokumen utama
     */
    public function getFileUrlAttribute(): string
    {
        if (str_starts_with($this->file_dokumen, 'http://') || str_starts_with($this->file_dokumen, 'https://')) {
            return $this->file_dokumen;
        }

        if (str_starts_with($this->file_dokumen, 'uploads/')) {
            return asset($this->file_dokumen);
        }

        return asset('uploads/produk-hukum/' . $this->file_dokumen);
    }
}

