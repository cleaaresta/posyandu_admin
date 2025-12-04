<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'jadwal_id';

    // Poster tidak masuk fillable karena masuk tabel media
    protected $fillable = [
        'posyandu_id', 
        'tanggal', 
        'tema',
        'keterangan'
    ];

    protected $casts = ['tanggal' => 'date'];

    // Relasi ke Posyandu
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // RELASI KE MEDIA (POSTER)
    public function poster()
    {
        return $this->morphOne(Media::class, 'model', 'ref_table', 'ref_id')
                    ->latest();
    }
    
    // Accessor: URL Poster Aman
    public function getPosterUrlAttribute()
{
    if ($this->poster && $this->poster->file_url) {
        
        // --- PERBAIKAN KRITIS DI SINI ---
        // Cek apakah file fisik poster masih ada di storage/app/public
        if (Storage::disk('public')->exists($this->poster->file_url)) {
            return asset('storage/' . $this->poster->file_url);
        }
        // Jika file tidak ada, anggap tidak ada poster
        return null; 
    }
    // Jika tidak ada record poster
    return null; 
}

    // Scope Search
    public function scopeSearch(Builder $query, $request): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');
        
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('tema', 'like', '%' . $searchTerm . '%')
              ->orWhere('keterangan', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('posyandu', function ($rel) use ($searchTerm) {
                  $rel->where('nama', 'like', '%' . $searchTerm . '%');
              });
        });
    }
}