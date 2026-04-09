<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kos extends Model
{
    protected $table = 'kos';

    protected $fillable = [
        'nama_kos',
        'harga',
        'lokasi',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'kos_id');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'kos_id');
    }
}