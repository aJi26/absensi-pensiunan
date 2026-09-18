<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'npp' => 'ADMIN001',
            'name' => 'Administrator RO3',
            'email' => 'admin@jasamarga.co.id',
            'password' => Hash::make('password123'),
        ]);

        // 2. Buat Data Karyawan / Pensiunan (Sesuai Mockup Gambar)
        $dataKaryawan = [
            ['npp' => 'NPP001', 'nama' => 'Ahmad Fauzi', 'no_telepon' => '081234567890', 'tipe' => 'karyawan'],
            ['npp' => 'NPP002', 'nama' => 'Siti Aminah', 'no_telepon' => '081234567891', 'tipe' => 'karyawan'],
            ['npp' => 'NPP003', 'nama' => 'Budi Santoso', 'no_telepon' => '081234567892', 'tipe' => 'karyawan'],
            ['npp' => 'NPP004', 'nama' => 'Dewi Lestari', 'no_telepon' => '081234567893', 'tipe' => 'karyawan'],
            ['npp' => 'NPP005', 'nama' => 'Rudi Hermawan', 'no_telepon' => '081234567894', 'tipe' => 'karyawan'],
        ];

        foreach ($dataKaryawan as $item) {
            Karyawan::create($item);
        }
    }
}
