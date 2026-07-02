<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan UNIQUE constraint pada kolom nim di tabel users.
     * Mencegah satu NIM digunakan untuk membuat lebih dari satu akun.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan unique index pada nim (nullable columns boleh NULL ganda, tapi value non-NULL harus unik)
            $table->unique('nim', 'users_nim_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_nim_unique');
        });
    }
};
