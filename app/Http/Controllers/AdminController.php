<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Rekap;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RekapExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // Dashboard Admin (Statistik Ringkasan)
    public function dashboard()
    {
        $totalData = Rekap::count();
        $dataBulanIni = Rekap::whereMonth('tanggal_pengisian', Carbon::now()->month)->count();
        $dataTahunIni = Rekap::whereYear('tanggal_pengisian', Carbon::now()->year)->count();

        return view('admin.dashboard', compact('totalData', 'dataBulanIni', 'dataTahunIni'));
    }

    // Halaman Rekap (Download PDF/Excel)
    public function rekap()
    {
        return view('admin.rekap');
    }

    // Halaman Cetak Laporan & Filter Data
    public function cetakLaporan(Request $request)
    {
        $tahun = $request->input('tahun', Carbon::now()->year);
        $bulan = $request->input('bulan');

        $query = Rekap::with('karyawan')->whereYear('tanggal_pengisian', $tahun);

        if ($bulan) {
            $query->whereMonth('tanggal_pengisian', $bulan);
        }

        $rekaps = $query->latest()->get();

        return view('admin.cetak', compact('rekaps', 'tahun', 'bulan'));
    }

    // Halaman Form Edit Data Karyawan
    public function editData()
    {
        $karyawans = Karyawan::all();
        return view('admin.edit', compact('karyawans'));
    }

    // Export ke Excel
    public function exportExcel(Request $request)
    {
        return Excel::download(new RekapExport($request->bulan, $request->tahun), 'Rekap_Karyawan.xlsx');
    }

    // Export ke PDF
    public function exportPdf(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan');

        $query = Rekap::with('karyawan')->whereYear('tanggal_pengisian', $tahun);
        if ($bulan) {
            $query->whereMonth('tanggal_pengisian', $bulan);
        }

        $rekaps = $query->get();
        $pdf = Pdf::loadView('admin.pdf', compact('rekaps'));
        return $pdf->download('Rekap_Karyawan.pdf');
    }

    // Update Data Karyawan
    public function updateKaryawan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_telepon' => 'nullable'
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
        ]);

        return back()->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Tambah Data Karyawan Baru (Create)
    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'npp' => 'required|unique:karyawans,npp',
            'nama' => 'required',
            'no_telepon' => 'nullable',
            'tipe' => 'required|in:karyawan,ahli_waris',
        ], [
            'npp.unique' => 'NPP sudah terdaftar dalam sistem!'
        ]);

        Karyawan::create([
            'npp' => $request->npp,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'tipe' => $request->tipe,
        ]);

        return back()->with('success', 'Data karyawan baru berhasil ditambahkan!');
    }

    // Hapus Data Karyawan (Delete)
    public function destroyKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return back()->with('success', 'Data karyawan berhasil dihapus!');
    }

    // Cetak Dokumen Satuan / Individual Karyawan
    public function cetakIndividual($id)
    {
        $rekap = Rekap::with('karyawan')->findOrFail($id);
        
        return view('admin.cetak_individual', compact('rekap'));
    }
}
