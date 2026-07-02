<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMahasiswa extends Model
{
    /**
     * Tabel sumber data resmi mahasiswa Politeknik Negeri Bengkalis.
     * Digunakan untuk memverifikasi NIM saat proses registrasi akun.
     */
    protected $table = 'master_mahasiswa';

    /**
     * Primary key adalah NIM (string), bukan auto-increment integer.
     */
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Kolom yang boleh di-mass-assign.
     */
    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'program_studi',
        'angkatan',
    ];
}
