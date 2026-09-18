<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    protected $fillable = ['npp', 'nama', 'no_telepon', 'tipe'];

    // Relasi: 1 Karyawan memiliki banyak Riwayat Rekap
    public function rekaps(): HasMany
    {
        return $this->hasMany(Rekap::class);
    }
}
