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
    // Gunakan hasOne biasa karena di Controller Anda mengisi 'ref_id' secara manual
    return $this->hasOne(Media::class, 'ref_id', 'jadwal_id')
                ->where('ref_table', 'jadwal_posyandu');
}
    
    // Accessor: URL Poster Aman
// Accessor: URL Poster Aman
    public function getPosterUrlAttribute()
    {
        // 1. Cek apakah ada relasi poster dan path-nya
        if ($this->poster && $this->poster->file_url) {
            
            // 2. Cek fisik file di storage (Agar tidak error jika file terhapus manual)
            if (Storage::disk('public')->exists($this->poster->file_url)) {
                return asset('storage/' . $this->poster->file_url);
            }
        }

        // 3. Jika tidak ada poster atau file hilang, return Default Placeholder
        // Pastikan path ini sesuai dengan struktur folder public Anda
        return asset('assets-admin/img/team/jadwal1.png'); 
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