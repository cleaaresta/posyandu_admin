<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    // === ACCESSOR GAMBAR UTAMA (BARU) ===
    public function getGambarUtamaAttribute()
    {
        // 1. Cek apakah ada foto dokumentasi imunisasi?
        $fotoDokumentasi = $this->dokumentasi->first();

        if ($fotoDokumentasi && $fotoDokumentasi->file_url) {
            return asset('storage/' . $fotoDokumentasi->file_url);
        }

        // 2. Jika tidak ada, gunakan Foto Profil Warga
        if ($this->warga && $this->warga->foto_url) {
            return $this->warga->foto_url;
        }

        // 3. Jika dua-duanya tidak ada, gambar default
        return asset('images/default-user.png');
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
                  $rel->where('nama', 'like', '%' . $searchTerm . '%');
              });
        });
    }
}