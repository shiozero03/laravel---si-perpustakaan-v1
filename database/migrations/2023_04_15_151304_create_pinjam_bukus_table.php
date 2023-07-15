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
        Schema::create('pinjam_bukus', function (Blueprint $table) {
            $table->id('id_pinjam');
            $table->string('id_member');
            $table->string('id_buku');
            $table->date('tanggal_peminjaman');
            $table->date('jatuh_tempo');
            $table->date('tanggal_dikembalikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_bukus');
    }
};
