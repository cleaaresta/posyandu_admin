<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada
use App\Models\Media; 

class CatatanImunisasi extends Model
{
    use HasFactory;

    protected $table = 'catatan_imunisasi';
    protected $primaryKey = 'imunisasi_id';

    protected $fillable = [
        'warga_id',
        'jenis_vaksin',
        'tanggal',
        'lokasi',
        'nakes',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi Dokumentasi
    public function dokumentasi()
    {
        return $this->morphMany(Media::class, 'model', 'ref_table', 'ref_id')
                    ->orderBy('sort_order', 'asc');
    }

    // === ACCESSOR GAMBAR UTAMA (Hanya Satu Fungsi Ini) ===
    public function getGambarUtamaAttribute()
    {
        // 1. Cek Dokumentasi Imunisasi (Prioritas Utama)
        $fotoDokumentasi = $this->dokumentasi->first();

        // Cek data di DB DAN cek fisik file di storage
        if ($fotoDokumentasi && $fotoDokumentasi->file_url) {
            if (Storage::disk('public')->exists($fotoDokumentasi->file_url)) {
                return asset('storage/' . $fotoDokumentasi->file_url);
            }
        }   

        return asset('assets-admin/img/team/catatan.jpg');
    }

    // Scope Search
    public function scopeSearch(Builder $query, $request): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');

        return $query->where(function ($q) use ($searchTerm) {
            $q->where('jenis_vaksin', 'like', '%' . $searchTerm . '%')
              ->orWhere('nakes', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('warga', function ($rel) use ($searchTerm) {
                  $rel->where('nama', 'like', '%' . $searchTerm . '%')
                      ->orWhere('nik', 'like', '%' . $searchTerm . '%');
              });
        });
    }
}