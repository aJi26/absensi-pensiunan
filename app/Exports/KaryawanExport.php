<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Karyawan::orderBy('npp', 'asc')->get();
    }

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

    public function map($karyawan): array
    {
        $rawTipe = strtolower(trim($karyawan->tipe_keanggotaan ?? $karyawan->tipe ?? ''));
        $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);

        return [
            $karyawan->npp,
            $karyawan->nama,
            $karyawan->no_telepon ?? '-',
            $isAhliWaris ? 'Ahli Waris' : 'Karyawan',
            $karyawan->nama_ahli_waris ?? '-',
            $karyawan->hubungan_ahli_waris ?? '-',
            $karyawan->no_hp_ahli_waris ?? '-',
        ];
    }
}