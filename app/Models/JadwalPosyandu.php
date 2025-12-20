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

    protected $fillable = [
        'posyandu_id', 
        'tanggal', 
        'tema',
        'keterangan'
    ];

    protected $casts = ['tanggal' => 'date'];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    public function poster()
    {
        return $this->morphOne(Media::class, 'model', 'ref_table', 'ref_id')
                    ->latest();
    }
    
    /**
     * Logika Prioritas:
     * 1. Jika ada upload di storage -> Pakai file upload.
     * 2. Jika tidak ada -> Pakai default assets.
     */
    public function getPosterUrlAttribute()
    {
        if ($this->poster && $this->poster->file_url) {
            // Cek apakah file fisik benar-benar ada di storage
            if (Storage::disk('public')->exists($this->poster->file_url)) {
                return asset('storage/' . $this->poster->file_url);
            }
        }

        // Default jika tidak ada upload
        return asset('assets-admin/img/team/jadwal1.png'); 
    }

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