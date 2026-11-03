<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_peraturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // contoh: Peraturan Daerah
            $table->string('singkatan')->nullable(); // contoh: PERDA
            $table->string('slug')->unique(); // contoh: peraturan-daerah
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_peraturans');
    }
};
