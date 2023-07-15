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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('no_panggil')->unique();
            $table->string('judul_buku');
            $table->string('cover_buku');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('tahun_terbit');
            $table->string('tempat_terbit');
            $table->string('halaman');
            $table->string('bahasa');
            $table->longtext('sinopsis');
            $table->string('status');
            $table->string('rating');
            $table->string('jumlah_penilai');
            $table->string('total_rate');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
