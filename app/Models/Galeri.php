<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'kos_id',
        'foto',
    ];

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}