<?php

namespace App\Imports;

use App\Models\Karyawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class KaryawanImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $index => $row) {
                // Skip baris pertama (Header Judul Kolom)
                if ($index === 0) {
                    continue;
                }

                // Ambil data berdasarkan posisi kolom Excel (0 = NPP, 1 = Nama, 2 = Telepon, 3 = Tipe, dst)
                $npp        = isset($row[0]) ? trim((string)$row[0]) : null;
                $nama       = isset($row[1]) ? trim((string)$row[1]) : null;
                $noTelepon  = isset($row[2]) ? trim((string)$row[2]) : null;
                $rawTipe    = isset($row[3]) ? trim((string)$row[3]) : 'karyawan';
                $namaAhli   = isset($row[4]) ? trim((string)$row[4]) : null;
                $hubAhli    = isset($row[5]) ? trim((string)$row[5]) : null;
                $hpAhli     = isset($row[6]) ? trim((string)$row[6]) : null;

                // Jika NPP atau Nama kosong, lewati
                if (empty($npp) || empty($nama)) {
                    continue;
                }

                // Auto-fix NPP jika angka 0 di depan hilang
                if (is_numeric($npp) && strlen($npp) < 5) {
                    $npp = str_pad($npp, 5, '0', STR_PAD_LEFT);
                }

                // Auto-fix No Telepon jika angka 0 di depan hilang
                if ($noTelepon && str_starts_with($noTelepon, '8')) {
                    $noTelepon = '0' . $noTelepon;
                }

                // NORMALISASI TIPE KE FORMAT DATABASE MYSQL
                $cleanTipe = strtolower(trim($rawTipe));
                if (in_array($cleanTipe, ['ahli waris', 'ahli_waris', 'ahli-waris'])) {
                    $valTipe            = 'ahli_waris';
                    $valTipeKeanggotaan = 'Ahli Waris';
                } else {
                    $valTipe            = 'karyawan';
                    $valTipeKeanggotaan = 'Karyawan';
                }

                // Simpan atau Update jika NPP sudah ada
                Karyawan::updateOrCreate(
                    ['npp' => $npp],
                    [
                        'nama'                => $nama,
                        'no_telepon'          => $noTelepon,
                        'tipe'                => $valTipe,
                        'tipe_keanggotaan'    => $valTipeKeanggotaan,
                        'nama_ahli_waris'     => $namaAhli,
                        'hubungan_ahli_waris' => $hubAhli,
                        'no_hp_ahli_waris'    => $hpAhli,
                    ]
                );
            }
        });
    }
}