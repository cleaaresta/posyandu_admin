<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderPosyandu extends Model
{
    use HasFactory;

    protected $table = 'kader_posyandu';
    protected $primaryKey = 'kader_id';

    // WAJIB: Daftarkan semua kolom agar bisa disimpan
    protected $fillable = [
        'posyandu_id',
        'warga_id',
        'peran',
        'mulai_tugas',
        'akhir_tugas',
    ];

    protected $casts = [
        'mulai_tugas' => 'date',
        'akhir_tugas' => 'date',
    ];

    // Relasi ke Warga (untuk ambil nama & foto)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Posyandu (untuk ambil tempat tugas)
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }
}