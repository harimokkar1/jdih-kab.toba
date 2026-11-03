<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JenisPeraturan extends Model
{
    protected $table = 'jenis_peraturans';

    protected $fillable = [
        'nama',
        'singkatan',
        'slug',
        'deskripsi',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function peraturans(): HasMany
    {
        return $this->hasMany(Peraturan::class, 'jenis_peraturan_id')->latest();
    }
}
