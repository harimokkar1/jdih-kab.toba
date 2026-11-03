<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peraturans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_peraturan_id')->constrained('jenis_peraturans')->cascadeOnDelete();
            
            $table->string('tipe_dokumen')->nullable()->default('Peraturan Perundang-undangan');
            $table->text('judul');
            $table->string('nomor_peraturan')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('teu_badan')->nullable();
            $table->string('tempat_penetapan')->nullable()->default('Balige');
            $table->date('tanggal_penetapan')->nullable();
            $table->date('tanggal_pengundangan')->nullable();
            $table->date('tanggal_upload')->nullable();
            
            $table->text('sumber')->nullable();
            $table->text('subjek')->nullable();
            $table->string('bahasa')->nullable()->default('Bahasa Indonesia');
            $table->string('lokasi')->nullable()->default('Bagian Hukum Setdakab Toba');
            $table->string('bidang_hukum')->nullable();
            $table->text('abstrak')->nullable();
            
            $table->enum('status', ['BERLAKU', 'TIDAK BERLAKU'])->default('BERLAKU');
            $table->string('file_dokumen');
            $table->string('english_version')->nullable();
            $table->string('braille')->nullable();
            $table->string('alih_suara')->nullable();
            
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peraturans');
    }
};
