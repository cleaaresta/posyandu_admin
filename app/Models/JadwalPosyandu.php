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
    protected $primaryKey = 'jadwal_id'; // Kunci utama Anda

    protected $fillable = [
        'posyandu_id', 
        'tanggal', 
        'tema',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // PERBAIKAN: Gunakan hasOne biasa agar sinkron dengan cara simpan di Controller
    public function poster()
    {
        return $this->hasOne(Media::class, 'ref_id', 'jadwal_id')
                    ->where('ref_table', 'jadwal_posyandu');
    }
    
    // Accessor untuk menampilkan gambar
    public function getPosterUrlAttribute()
    {
        if ($this->poster && $this->poster->file_url) {
            if (Storage::disk('public')->exists($this->poster->file_url)) {
                return asset('storage/' . $this->poster->file_url);
            }
        }
        // Gambar default jika file tidak ada
        return asset('assets-admin/img/team/jadwal1.png'); 
    }

    public function scopeSearch(Builder $query, $request): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');
        
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('tema', 'like', '%' . $searchTerm . '%')
              ->orWhere('keterangan', 'like', '%' . $searchTerm . '%');
        });
    }
}