<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_organisasis', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('jabatan');

            // Tingkat struktur organisasi
            $table->integer('tingkat')->default(1);

            // Atasan dari jabatan tersebut
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('struktur_organisasis')
                ->nullOnDelete();

            // Foto pejabat
            $table->string('foto')->nullable();

            // Untuk mengatur urutan
            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};