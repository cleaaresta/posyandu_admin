<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
     use HasFactory; // Baris ini butuh import di atas

    // Nama tabel sesuai migration
    protected $table = 'posyandu';

    // Primary key custom
    protected $primaryKey = 'posyandu_id';

    // Kolom yang boleh di-mass assign
    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'kontak',
        'foto',
    ];

    // ... sisa kode Anda (casts, dll) biarkan saja ...

    // Casting tipe data
    protected $casts = [
        'posyandu_id' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
