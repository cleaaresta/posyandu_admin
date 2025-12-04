<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';

    protected $fillable = [
        'nama', 'alamat', 'rt', 'rw', 'kontak',
    ];

    // Relasi Foto Profil (Satu Foto)
    public function foto()
    {
        return $this->morphOne(Media::class, 'model', 'ref_table', 'ref_id')
                    ->latest(); // Ambil yang terbaru
    }

    

    // Relasi Galeri (Banyak Foto - Jika posyandu punya album kegiatan umum)
    public function galeri()
    {
        return $this->morphMany(Media::class, 'model', 'ref_table', 'ref_id');
    }

    // Accessor: URL Foto Profil Aman
    public function getFotoUrlAttribute()
    {
        // Cek apakah relasi foto ada datanya
        if ($this->foto && $this->foto->file_url) {
            // PERBAIKAN: Tambahkan asset('storage/ ... ')
            return asset('storage/' . $this->foto->file_url);
        }

        // Jika tidak ada foto, pakai gambar default
        return asset('images/default-posyandu.png'); 
        // Atau pakai link avatar online agar langsung muncul tanpa perlu file gambar:
        // return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=random&color=fff';
    }

    // === SCOPE SEARCH (Sesuai kode lama Anda) ===
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