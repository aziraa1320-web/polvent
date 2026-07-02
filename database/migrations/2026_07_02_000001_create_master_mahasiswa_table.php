<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Buat tabel master_mahasiswa sebagai sumber data resmi mahasiswa Polbeng.
     * Digunakan untuk verifikasi NIM saat registrasi akun.
     */
    public function up(): void
    {
        Schema::create('master_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 20)->primary();
            $table->string('nama', 255);
            $table->string('jurusan', 255);
            $table->string('program_studi', 255);
            $table->string('angkatan', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_mahasiswa');
    }
};
