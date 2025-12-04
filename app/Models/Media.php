<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    // Pastikan fillable lengkap
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Relasi Balik (Polymorphic)
     * Menemukan pemilik file ini (misal: row di tabel Posyandu atau Warga)
     */
    public function model()
    {
        // Parameter: nama_fungsi, nama_kolom_tipe, nama_kolom_id
        return $this->morphTo(__FUNCTION__, 'ref_table', 'ref_id');
    }
}