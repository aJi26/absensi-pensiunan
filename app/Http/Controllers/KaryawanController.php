<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Rekap;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    // Method untuk menampilkan halaman form login
    public function showLoginForm(Request $request)
    {
        $loginType = $request->query('type', session('is_ahli_waris_mode') ? 'ahli-waris' : 'karyawan');
        return view('user.login', compact('loginType'));
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'npp'        => 'required',
            'login_type' => 'required|in:karyawan,ahli-waris',
        ]);

        $karyawan = Karyawan::where('npp', trim($request->npp))->first();

        if (!$karyawan) {
            return back()->with('error', 'NPP tidak terdaftar!');
        }

        $rawTipe = strtolower(trim($karyawan->tipe_keanggotaan ?? 'karyawan'));
        $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
        $loginType = $request->input('login_type');

        if ($isAhliWaris && $loginType === 'karyawan') {
            return back()->with('error', '⚠️ NPP ini telah resmi beralih status ke Ahli Waris. Silakan login melalui menu Login Ahli Waris.');
        }

        if (!$isAhliWaris && $loginType === 'ahli-waris') {
            return back()->with('error', '⚠️ NPP ini masih terdaftar sebagai Karyawan aktif. Silakan login melalui menu Login Karyawan.');
        }

        session([
            'karyawan_id'  => $karyawan->id,
            'karyawan_npp' => $karyawan->npp,
        ]);

        if (!$karyawan->foto_referensi) {
            return redirect()->route('karyawan.registrasi');
        }

        return redirect()->route('karyawan.beranda');
    }

    public function info()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);

        $presensiBulanIni = Rekap::where('karyawan_id', $karyawanId)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->first();

        return view('user.info', compact('karyawan', 'presensiBulanIni'));
    }

    public function riwayat()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        $rekaps = Rekap::where('karyawan_id', $karyawanId)->latest()->get();

        $presensiBulanIni = Rekap::where('karyawan_id', $karyawanId)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->first();

        return view('user.riwayat', compact('karyawan', 'rekaps', 'presensiBulanIni'));
    }

    public function panduan()
    {
        return view('user.panduan');
    }

    public function logout(Request $request)
    {
        session()->forget(['karyawan_id', 'karyawan_npp', 'last_rekap_id']);
        return redirect()->route('welcome');
    }

    public function registrasiForm()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);

        if ($karyawan->foto_referensi) {
            return redirect()->route('karyawan.beranda');
        }

        return view('user.registrasi_wajah', compact('karyawan'));
    }

    // Simpan Foto Master (Dinamis Sesuai Disk .env)
    public function storeRegistrasi(Request $request)
    {
        try {
            $karyawanId = session('karyawan_id');
            if (!$karyawanId) {
                return response()->json(['success' => false, 'message' => 'Sesi berakhir, silakan login ulang.'], 401);
            }

            $request->validate([
                'image' => 'required',
                'descriptor' => 'required'
            ]);

            $karyawan = Karyawan::findOrFail($karyawanId);

            $imageParts = explode(";base64,", $request->image);
            $imageBase64 = base64_decode(end($imageParts));

            $disk = config('filesystems.default', 'public');
            if ($disk === 'public' && !Storage::disk('public')->exists('referensi')) {
                Storage::disk('public')->makeDirectory('referensi');
            }

            $fileName = 'ref_' . $karyawan->npp . '_' . time() . '.jpg';
            Storage::disk($disk)->put('referensi/' . $fileName, $imageBase64);

            $karyawan->foto_referensi = 'referensi/' . $fileName;
            $karyawan->face_descriptor = json_encode($request->descriptor);
            $karyawan->save();

            Rekap::where('karyawan_id', $karyawanId)
                ->whereMonth('tanggal_pengisian', Carbon::now()->month)
                ->whereYear('tanggal_pengisian', Carbon::now()->year)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Registrasi foto & sidik wajah master berhasil!',
                'redirect' => route('karyawan.beranda')
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error Server: ' . $e->getMessage()], 500);
        }
    }

    public function beralihAhliWarisForm()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        return view('user.ahli_waris', compact('karyawan'));
    }

    public function regisAhliWarisForm()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        return view('user.regis_ahli_waris');
    }

    public function storeRegisAhliWaris(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required',
                'descriptor' => 'required'
            ]);

            session([
                'temp_ahli_waris_face' => [
                    'image' => $request->image,
                    'descriptor' => $request->descriptor
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi foto wajah ahli waris berhasil!',
                'redirect' => route('karyawan.beralih.form')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function prosesBeralihAhliWaris(Request $request)
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $request->validate([
            'nama_ahli_waris' => 'required|string|max:255',
            'hubungan_ahli_waris' => 'required|string',
            'no_hp_ahli_waris' => 'required|string|min:10|max:20',
        ]);

        if (!session()->has('temp_ahli_waris_face')) {
            return back()->with('error', 'Silakan lakukan registrasi wajah Ahli Waris terlebih dahulu!');
        }

        $karyawan = Karyawan::findOrFail($karyawanId);
        $faceData = session('temp_ahli_waris_face');

        $imageParts = explode(";base64,", $faceData['image']);
        $imageBase64 = base64_decode(end($imageParts));

        $disk = config('filesystems.default', 'public');
        if ($disk === 'public' && !Storage::disk('public')->exists('referensi')) {
            Storage::disk('public')->makeDirectory('referensi');
        }

        $fileName = 'ref_ahliwaris_' . $karyawan->npp . '_' . time() . '.jpg';
        Storage::disk($disk)->put('referensi/' . $fileName, $imageBase64);

        $karyawan->tipe_keanggotaan = 'Ahli Waris';
        $karyawan->nama_ahli_waris = $request->nama_ahli_waris;
        $karyawan->hubungan_ahli_waris = $request->hubungan_ahli_waris;
        $karyawan->no_hp_ahli_waris = $request->no_hp_ahli_waris;
        $karyawan->foto_referensi = 'referensi/' . $fileName;
        $karyawan->face_descriptor = json_encode($faceData['descriptor']);
        $karyawan->save();

        Rekap::where('karyawan_id', $karyawanId)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->delete();

        session()->forget(['temp_ahli_waris_face', 'karyawan_id', 'karyawan_npp', 'last_rekap_id']);
        session(['is_ahli_waris_mode' => true]);

        return redirect()->route('welcome')->with('success', 'Pelaporan almarhum berhasil! Akun resmi beralih ke Ahli Waris.');
    }

    public function scan()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);

        if (!$karyawan->foto_referensi) {
            return redirect()->route('karyawan.registrasi');
        }

        $presensiBulanIni = Rekap::where('karyawan_id', $karyawanId)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->first();

        if ($presensiBulanIni) {
            return redirect()->route('karyawan.beranda');
        }

        return view('user.scan', compact('karyawan', 'presensiBulanIni'));
    }

    // Simpan Foto Scan Presensi (Dinamis Sesuai Disk .env)
    public function storeScan(Request $request)
    {
        try {
            $karyawanId = session('karyawan_id');
            if (!$karyawanId) {
                return response()->json(['success' => false, 'message' => 'Sesi berakhir.'], 401);
            }

            $presensiBulanIni = Rekap::where('karyawan_id', $karyawanId)
                ->whereMonth('tanggal_pengisian', Carbon::now()->month)
                ->whereYear('tanggal_pengisian', Carbon::now()->year)
                ->first();

            if ($presensiBulanIni) {
                session(['last_rekap_id' => $presensiBulanIni->id]);
                return response()->json([
                    'success' => true,
                    'message' => 'Presensi bulan ini sudah pernah dicatat.'
                ]);
            }

            $request->validate(['image' => 'required']);

            $imageParts = explode(";base64,", $request->image);
            $imageBase64 = base64_decode(end($imageParts));

            $disk = config('filesystems.default', 'public');
            if ($disk === 'public' && !Storage::disk('public')->exists('scans')) {
                Storage::disk('public')->makeDirectory('scans');
            }

            $fileName = 'scan_' . $karyawanId . '_' . time() . '.jpg';
            Storage::disk($disk)->put('scans/' . $fileName, $imageBase64);

            $rekap = Rekap::create([
                'karyawan_id' => $karyawanId,
                'foto' => 'scans/' . $fileName,
                'tanggal_pengisian' => Carbon::now(),
            ]);

            session(['last_rekap_id' => $rekap->id]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error Server: ' . $e->getMessage()], 500);
        }
    }

    public function success()
    {
        $karyawanId = session('karyawan_id');
        $rekapId = session('last_rekap_id');
        if (!$karyawanId || !$rekapId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);
        $rekap = Rekap::findOrFail($rekapId);

        return view('user.success', compact('karyawan', 'rekap'));
    }

    public function beranda()
    {
        $karyawanId = session('karyawan_id');
        if (!$karyawanId) return redirect()->route('welcome');

        $karyawan = Karyawan::findOrFail($karyawanId);

        if (!$karyawan->foto_referensi) {
            return redirect()->route('karyawan.registrasi');
        }

        $lastRekap = Rekap::where('karyawan_id', $karyawanId)->latest()->first();

        $presensiBulanIni = Rekap::where('karyawan_id', $karyawanId)
            ->whereMonth('tanggal_pengisian', Carbon::now()->month)
            ->whereYear('tanggal_pengisian', Carbon::now()->year)
            ->latest()
            ->first();

        return view('user.beranda', compact('karyawan', 'presensiBulanIni', 'lastRekap'));
    }
}