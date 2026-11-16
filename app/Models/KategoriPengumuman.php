<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriPengumuman extends Model
{
    protected $table = 'kategori_pengumumen';

    protected $fillable = [
        'nama',
        'slug',
        'urutan',
    ];

    public function pengumumans()
    {
        return $this->hasMany(Pengumuman::class, 'kategori_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }
}
