<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Rekap;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    // Halaman Informasi Karyawan setelah Login
    public function info()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        return view('user.info', compact('karyawan'));
    }

    // Halaman Kamera / Scan Wajah
    public function scan()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        return view('user.scan');
    }

    // Proses Menyimpan Foto dari Kamera (AJAX Base64)
    public function storeScan(Request $request)
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) {
            return response()->json(['success' => false, 'message' => 'Sesi berakhir, silakan login ulang.'], 401);
        }

        $request->validate([
            'image' => 'required'
        ]);

        // Decode data gambar Base64 dari kamera
        $imageParts = explode(";base64,", $request->image);
        $imageBase64 = base64_decode($imageParts[1]);

        // Buat nama file unik
        $fileName = 'scan_' . $karyawanId . '_' . time() . '.png';
        Storage::disk('public')->put('scans/' . $fileName, $imageBase64);

        // Simpan riwayat ke database
        $rekap = Rekap::create([
            'karyawan_id' => $karyawanId,
            'foto' => 'scans/' . $fileName,
            'tanggal_pengisian' => Carbon::now(),
        ]);

        session(['last_rekap_id' => $rekap->id]);

        return response()->json(['success' => true]);
    }

    // Halaman Notifikasi Berhasil Disimpan
    public function success()
    {
        $karyawanId = session('karyawan_id');
        $rekapId = session('last_rekap_id');
        if (!$karyawanId || !$rekapId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        $rekap = Rekap::findOrFail($rekapId);

        return view('user.success', compact('karyawan', 'rekap'));
    }

    // Halaman Beranda / Menu Utama User
    public function beranda()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        $lastRekap = Rekap::where('karyawan_id', $karyawanId)->latest()->first();

        return view('user.beranda', compact('karyawan', 'lastRekap'));
    }
}
