<?php
// NAMA FILE: app/Models/JadwalPosyandu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'jadwal_posyandu';

    // Primary key custom
    protected $primaryKey = 'jadwal_id';

    // Kolom yang boleh di-mass assign
    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'tema',
        'keterangan',
        'poster',
    ];

    // Casting tipe data (agar 'tanggal' mudah di-format)
    protected $casts = [
        'jadwal_id' => 'integer',
        'posyandu_id' => 'integer',
        'tanggal' => 'date', // Otomatis konversi ke objek Carbon
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke Posyandu.
     * Satu jadwal hanya dimiliki oleh satu posyandu.
     */
    public function posyandu()
    {
        // (Model, foreign_key, local_key)
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }
}