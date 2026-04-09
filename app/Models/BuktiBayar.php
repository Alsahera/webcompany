<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuktiBayar extends Model
{
    protected $table = 'bukti_bayar';

    protected $fillable = [
        'booking_id',
        'file_bukti',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}