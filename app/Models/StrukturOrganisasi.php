<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis';

    protected $fillable = [
        'nama',
        'jabatan',
        'tingkat',
        'parent_id',
        'foto',
        'urutan',
    ];

    /**
     * Atasan
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            StrukturOrganisasi::class,
            'parent_id'
        );
    }

    /**
     * Bawahan
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            StrukturOrganisasi::class,
            'parent_id'
        )->orderBy('urutan');
    }
}