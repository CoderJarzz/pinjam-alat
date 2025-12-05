<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'merk',
        'harga_sewa',
        'stok_total',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $casts = [
        'stok_total' => 'integer',
    ];

    public function sewas(): HasMany
    {
        return $this->hasMany(Sewa::class);
    }

    public function activeSewas(): HasMany
    {
        return $this->sewas()->whereIn('status', Sewa::occupyingStatuses());
    }

    public function stokTerpakai(): int
    {
        return $this->activeSewas()->count();
    }

    public function stokTersedia(): int
    {
        return max($this->stok_total - $this->stokTerpakai(), 0);
    }

    public function syncAvailability(): void
    {
        $newStatus = $this->stokTersedia() > 0 ? 'tersedia' : 'disewa';

        if ($this->status !== $newStatus) {
            $this->status = $newStatus;
            $this->saveQuietly();
        }
    }
}
