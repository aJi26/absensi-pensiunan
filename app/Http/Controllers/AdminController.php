<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Rekap;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RekapExport;
use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;
use App\Exports\KaryawanTemplate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalData = Rekap::count();
        $dataBulanIni = Rekap::whereMonth('tanggal_pengisian', Carbon::now()->month)->count();
        $dataTahunIni = Rekap::whereYear('tanggal_pengisian', Carbon::now()->year)->count();

        return view('admin.dashboard', compact('totalData', 'dataBulanIni', 'dataTahunIni'));
    }

    public function dataKaryawan(Request $request)
    {
        $search = $request->input('search');
        
        $karyawans = Karyawan::when($search, function($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('npp', 'like', "%{$search}%");
        })->orderBy('npp', 'asc')->get();

        return view('admin.karyawan', compact('karyawans', 'search'));
    }

    // Reset Wajah (Dinamis Sesuai Disk .env)
    public function resetWajah($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $disk = config('filesystems.default', 'public');

        if ($karyawan->foto_referensi && Storage::disk($disk)->exists($karyawan->foto_referensi)) {
            Storage::disk($disk)->delete($karyawan->foto_referensi);
        }

        $karyawan->foto_referensi = null;
        $karyawan->save();

        Rekap::where('karyawan_id', $id)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->delete();

        return redirect()->back()->with('success', 'Foto master dan status presensi bulan ini berhasil direset!');
    }

    public function rekap()
    {
        return view('admin.rekap');
    }

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

    public function editData()
    {
        $karyawans = Karyawan::orderBy('npp', 'asc')->get();
        return view('admin.edit', compact('karyawans'));
    }

    public function updateTipe(Request $request, $id)
    {
        $request->validate([
            'tipe' => 'required|string',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        
        $karyawan->tipe = $request->tipe;
        $karyawan->tipe_keanggotaan = $request->tipe;
        $karyawan->save();

        return redirect()->back()->with('success', 'Tipe keanggotaan ' . $karyawan->nama . ' berhasil diubah menjadi ' . $request->tipe);
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan');

        if ($bulan) {
            $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->isoFormat('MMMM_Y');
            $fileName = 'Rekap_Presensi_Jasamarga_' . $namaBulan . '.xlsx';
        } else {
            $fileName = 'Rekap_Presensi_Jasamarga_Tahun_' . $tahun . '.xlsx';
        }

        return Excel::download(new RekapExport($bulan, $tahun), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan');

        $query = Rekap::with('karyawan')->whereYear('tanggal_pengisian', $tahun);

        if ($bulan) {
            $query->whereMonth('tanggal_pengisian', $bulan);
            $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->isoFormat('MMMM_Y');
            $fileName = 'Rekap_Presensi_Jasamarga_' . $namaBulan . '.pdf';
        } else {
            $fileName = 'Rekap_Presensi_Jasamarga_Tahun_' . $tahun . '.pdf';
        }

        $rekaps = $query->get();
        $pdf = Pdf::loadView('admin.pdf', compact('rekaps'));
        return $pdf->download($fileName);
    }

    public function exportKaryawanExcel()
    {
        return Excel::download(new KaryawanExport, 'Data_Karyawan_Jasamarga.xlsx');
    }

    public function importKaryawanExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls,csv|max:5120'
        ], [
            'file_excel.required' => 'Pilih file Excel terlebih dahulu!',
            'file_excel.mimes'    => 'Format file harus berupa Excel (.xlsx / .xls)!',
        ]);

        try {
            Excel::import(new KaryawanImport, $request->file('file_excel'));
            return back()->with('success', 'Berhasil mengimpor data karyawan dari file Excel!');
        } catch (\Exception $e) {
            return back()->withErrors(['Gagal import: ' . $e->getMessage()]);
        }
    }

    public function downloadTemplateExcel()
    {
        return Excel::download(new KaryawanTemplate, 'Template_Import_Karyawan.xlsx');
    }

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

    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'npp'        => 'required|regex:/^[0-9]{5,}$/|unique:karyawans,npp',
            'nama'       => 'required|string|max:255|unique:karyawans,nama',
            'no_telepon' => 'nullable|regex:/^[0-9]{10,}$/',
            'tipe'       => 'required',
        ], [
            'npp.required' => 'NPP wajib diisi!',
            'npp.regex'    => 'NPP harus berupa angka dan minimal 5 digit!',
            'npp.unique'   => 'NPP sudah terdaftar dalam sistem!',
            'nama.required' => 'Nama lengkap wajib diisi!',
            'nama.unique'   => 'Nama telah terpakai!',
            'no_telepon.regex' => 'Nomor telepon harus berupa angka dan minimal 10 digit!',
            'tipe.required' => 'Tipe akses/keanggotaan wajib dipilih!',
        ]);

        Karyawan::create([
            'npp'              => $request->npp,
            'nama'             => $request->nama,
            'no_telepon'       => $request->no_telepon,
            'tipe'             => $request->tipe,
            'tipe_keanggotaan' => $request->tipe,
        ]);

        return back()->with('success', 'Data karyawan baru berhasil ditambahkan!');
    }

    // Hapus Karyawan (Dinamis Sesuai Disk .env)
    public function destroyKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $disk = config('filesystems.default', 'public');
        
        if ($karyawan->foto_referensi && Storage::disk($disk)->exists($karyawan->foto_referensi)) {
            Storage::disk($disk)->delete($karyawan->foto_referensi);
        }

        $karyawan->delete();

        return back()->with('success', 'Data karyawan berhasil dihapus!');
    }

    public function cetakIndividual($id)
    {
        $rekap = Rekap::with('karyawan')->findOrFail($id);
        return view('admin.cetak_individual', compact('rekap'));
    }
}