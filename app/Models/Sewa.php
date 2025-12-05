<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sewa extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_BERHASIL = 'disetujui';
    public const STATUS_GAGAL = 'gagal';
    public const STATUS_SELESAI = 'selesai';

    protected $fillable = [
        'user_id',
        'barang_id',
        'nama_penyewa',
        'alamat',
        'nomor_ktp',
        'foto_ktp',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status',
        'faq_disetujui_pada',
        'alasan_penolakan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'total_harga' => 'decimal:2',
        'faq_disetujui_pada' => 'datetime',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function occupyingStatuses(): array
    {
        return [self::STATUS_PENDING, self::STATUS_BERHASIL];
    }
}
