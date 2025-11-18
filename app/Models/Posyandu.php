<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder; // <-- 1. Tambahkan Import Builder
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';

    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'kontak',
        'foto',
    ];

    protected $casts = [
        'posyandu_id' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // ==========================================
    // TAMBAHKAN DUA SCOPE DI BAWAH INI
    // ==========================================

    /**
     * Scope: Filter berdasarkan kolom yang persis (Exact Match)
     * Contoh: Filter berdasarkan RW atau RT jika nanti diperlukan
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
     * Scope: Search (Pencarian Mirip/Like)
     */
    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) {
            return $query;
        }

        $searchTerm = $request->input('search');

        return $query->where(function (Builder $q) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $index => $column) {
                if ($index === 0) {
                    $q->where($column, 'like', '%' . $searchTerm . '%');
                } else {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            }
        });
    }
}