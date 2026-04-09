<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'user_id',
        'kos_id',
        'tanggal_masuk',
        'durasi_sewa',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'booking_id');
    }

    public function buktiBayar(): HasOne
    {
        return $this->hasOne(BuktiBayar::class, 'booking_id');
    }
}