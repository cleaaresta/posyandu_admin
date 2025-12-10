<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use App\Models\Media; // Tambahkan ini

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // === RELASI MEDIA (FOTO PROFIL) ===
    public function foto()
    {
        return $this->morphOne(Media::class, 'model', 'ref_table', 'ref_id')
                    ->latest();
    }

    // === ACCESSOR URL FOTO (Safety Check) ===
    public function getFotoUrlAttribute()
    {
        // 1. Cek relasi dan path file di DB
        if ($this->foto && $this->foto->file_url) {
            // 2. Cek fisik file di storage
            if (Storage::disk('public')->exists($this->foto->file_url)) {
                return asset('storage/' . $this->foto->file_url);
            }
        }

        // 3. Fallback: Gunakan Avatar Default (Placeholder)
        return asset('assets-admin/img/team/profil.png');
        // Atau opsi online: return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff';
    }

    // ... (Scope Filter & Search tetap sama) ...
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) return $query;
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $value = $request->input($column);
                $query->where($column, $value);
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