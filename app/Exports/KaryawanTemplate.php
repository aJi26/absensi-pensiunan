<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KaryawanTemplate implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'NPP',
            'Nama Lengkap',
            'No. Telepon',
            'Tipe Keanggotaan',
            'Nama Ahli Waris',
            'Hubungan Ahli Waris',
            'No. HP Ahli Waris',
        ];
    }

    public function array(): array
    {
        return [
            [
                '07691',
                'Budi Santoso',
                '081234567890',
                'Karyawan',
                '',
                '',
                '',
            ],
            [
                '07692',
                'Bambang Wijaya',
                '082143658709',
                'Ahli Waris',
                'Dewi Wijaya',
                'Istri',
                '082199887766',
            ],
        ];
    }
}