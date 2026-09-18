<?php

namespace App\Exports;

use App\Models\Rekap;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    protected $bulan, $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun ?? date('Y');
    }

    public function collection()
    {
        $query = Rekap::with('karyawan')->whereYear('tanggal_pengisian', $this->tahun);
        if ($this->bulan) {
            $query->whereMonth('tanggal_pengisian', $this->bulan);
        }

        return $query->get()->map(function($item, $key) {
            return [
                'No' => $key + 1,
                'Nama' => $item->karyawan->nama,
                'NPP' => $item->karyawan->npp,
                'Tanggal Pengisian' => $item->tanggal_pengisian->format('d/m/Y H:i') . ' WIB',
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'NPP', 'Tanggal Pengisian'];
    }
}
