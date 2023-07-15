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
        Schema::create('members', function (Blueprint $table) {
            $table->id('id_member');
            $table->biginteger('nisn')->unique();
            $table->string('nama');
            $table->string('password');
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('foto_profil')->nullable();
            $table->string('role');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
