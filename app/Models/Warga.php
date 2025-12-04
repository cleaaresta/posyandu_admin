<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp', 'nama', 'jenis_kelamin', 'agama', 
        'pekerjaan', 'telp', 'email',
    ];

    // Relasi Foto Profil Warga
    public function foto()
    {
        return $this->morphOne(Media::class, 'model', 'ref_table', 'ref_id')
                    ->latest();
    }

    // Accessor
    public function getFotoUrlAttribute()
    {
        if ($this->foto && $this->foto->file_url) {
             // Tambahkan asset('storage/...')
            return asset('storage/' . $this->foto->file_url);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=random';
    }

    // Relasi Data Lain
    public function imunisasi() { return $this->hasMany(CatatanImunisasi::class, 'warga_id'); }
    public function layanan() { return $this->hasMany(LayananPosyandu::class, 'warga_id'); }

    // === SCOPE FILTER & SEARCH ===
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) return $query;
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');
        return $query->where(function (Builder $q) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $index => $column) {
                if ($index === 0) $q->where($column, 'like', '%' . $searchTerm . '%');
                else $q->orWhere($column, 'like', '%' . $searchTerm . '%');
            }
        });
    }
}