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
        Schema::create('simpan_bukus', function (Blueprint $table) {
            $table->id('id_simpan');
            $table->string('id_member');
            $table->string('id_buku');
            $table->date('tanggal_simpan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpan_bukus');
    }
};
