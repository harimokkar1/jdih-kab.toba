<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keputusan_bupatis', function (Blueprint $table) {
            $table->id();

            $table->string('tipe_dokumen')->nullable();
            $table->string('jenis')->nullable();

            $table->text('judul');

            $table->string('teu_badan')->nullable();

            $table->date('tanggal_upload')->nullable();

            $table->string('nomor_peraturan')->nullable();
            $table->string('jenis_peraturan')->nullable();
            $table->string('singkatan')->nullable();

            $table->string('tempat_penetapan')->nullable();
            $table->year('tahun')->nullable();

            $table->date('tanggal_penetapan')->nullable();
            $table->date('tanggal_pengundangan')->nullable();

            $table->text('sumber')->nullable();
            $table->text('subjek')->nullable();

            $table->string('bahasa')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('bidang_hukum')->nullable();

            $table->text('abstrak')->nullable();

            $table->string('english_version')->nullable();
            $table->string('braille')->nullable();
            $table->string('alih_suara')->nullable();

            $table->string('file_dokumen');

            $table->enum('status', [
                'BERLAKU',
                'TIDAK BERLAKU'
            ])->default('BERLAKU');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keputusan_bupatis');
    }
};