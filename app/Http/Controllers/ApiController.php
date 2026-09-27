<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Rekap;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ApiController extends Controller
{
    // 1. API Login Karyawan
    public function login(Request $request)
    {
        $request->validate(['npp' => 'required']);

        $karyawan = Karyawan::where('npp', $request->npp)->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'NPP tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $karyawan
        ]);
    }

    // 2. API Simpan Foto Scan
    public function storeScan(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'image' => 'required' // Base64 String
        ]);

        $imageParts = explode(";base64,", $request->image);
        $imageBase64 = base64_decode(end($imageParts));

        $fileName = 'scan_' . $request->karyawan_id . '_' . time() . '.png';
        Storage::disk('public')->put('scans/' . $fileName, $imageBase64);

        $rekap = Rekap::create([
            'karyawan_id' => $request->karyawan_id,
            'foto' => 'scans/' . $fileName,
            'tanggal_pengisian' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto presensi berhasil disimpan',
            'data' => $rekap
        ]);
    }

    // 3. API Riwayat Presensi
    public function getRiwayat($karyawanId)
    {
        $rekaps = Rekap::where('karyawan_id', $karyawanId)->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $rekaps
        ]);
    }
}
