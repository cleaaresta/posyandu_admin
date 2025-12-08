<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LayananPosyandu extends Model
{
    use HasFactory;

    protected $table = 'layanan_posyandu';
    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'jadwal_id',
        'warga_id',
        'berat',
        'tinggi',
        'vitamin',
        'konseling',
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(JadwalPosyandu::class, 'jadwal_id', 'jadwal_id');
    }

    // Scope Search (Pencarian Nama Warga / Tema Jadwal)
    public function scopeSearch(Builder $query, $request): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');

        return $query->where(function ($q) use ($searchTerm) {
            $q->where('vitamin', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('warga', function ($rel) use ($searchTerm) {
                  $rel->where('nama', 'like', '%' . $searchTerm . '%')
                      ->orWhere('no_ktp', 'like', '%' . $searchTerm . '%');
              })
              ->orWhereHas('jadwal', function ($rel) use ($searchTerm) {
                  $rel->where('tema', 'like', '%' . $searchTerm . '%');
              });
        });
    }
}