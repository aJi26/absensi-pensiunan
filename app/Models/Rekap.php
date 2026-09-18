<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rekap extends Model
{
    protected $fillable = ['karyawan_id', 'foto', 'tanggal_pengisian'];

    // Tambahkan casting datetime di bawah ini
    protected $casts = [
        'tanggal_pengisian' => 'datetime',
    ];

    // Relasi: Rekap terhubung ke 1 Karyawan
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }
}
