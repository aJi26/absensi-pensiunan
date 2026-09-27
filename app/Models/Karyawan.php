<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    protected $fillable = ['npp', 'nama', 'no_telepon', 'tipe', 'foto_referensi', 'face_descriptor', 'tipe_keanggotaan', 'nama_ahli_waris', 'hubungan_ahli_waris', 'no_hp_ahli_waris',];

    // Relasi: 1 Karyawan memiliki banyak Riwayat Rekap
    public function rekaps(): HasMany
    {
        return $this->hasMany(Rekap::class);
    }
}
