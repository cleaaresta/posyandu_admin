<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder; // <-- WAJIB ADA (Jangan sampai terlewat)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'tema',
        'keterangan',
        'poster',
    ];

    protected $casts = [
        'jadwal_id' => 'integer',
        'posyandu_id' => 'integer',
        'tanggal' => 'date',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // Relasi ke Posyandu
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // =========================================================
    //  SCOPE FILTER & SEARCH (INI YANG HILANG DI FILE ANDA)
    // =========================================================

    /**
     * Scope: Filter (Exact Match)
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) {
            return $query;
        }

        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $value = $request->input($column);
                $query->where($column, $value);
            }
        }
        return $query;
    }

    /**
     * Scope: Search (Pencarian Like)
     */
    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) {
            return $query;
        }

        $searchTerm = $request->input('search');

        return $query->where(function (Builder $q) use ($searchTerm, $searchableColumns) {
            // 1. Cari di kolom tabel jadwal (tema, keterangan)
            foreach ($searchableColumns as $index => $column) {
                if ($index === 0) {
                    $q->where($column, 'like', '%' . $searchTerm . '%');
                } else {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            }

            // 2. Cari juga berdasarkan Nama Posyandu (Relasi)
            $q->orWhereHas('posyandu', function ($relQuery) use ($searchTerm) {
                $relQuery->where('nama', 'like', '%' . $searchTerm . '%');
            });
        });
    }
}