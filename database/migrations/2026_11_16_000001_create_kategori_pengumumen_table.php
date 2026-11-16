<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('kategori_pengumumen')) {
            Schema::create('kategori_pengumumen', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('slug')->unique();
                $table->integer('urutan')->default(0);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('pengumumen') && !Schema::hasColumn('pengumumen', 'kategori_id')) {
            Schema::table('pengumumen', function (Blueprint $table) {
                $table->foreignId('kategori_id')
                    ->nullable()
                    ->after('judul')
                    ->constrained('kategori_pengumumen')
                    ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pengumumen') && Schema::hasColumn('pengumumen', 'kategori_id')) {
            Schema::table('pengumumen', function (Blueprint $table) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            });
        }

        Schema::dropIfExists('kategori_pengumumen');
    }
};
