<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman Pilihan Login Utama (Mobile Dashboard)
    public function index()
    {
        return view('user.welcome');
    }

    // Halaman Form Login Karyawan
    public function showLoginKaryawan()
    {
        return view('user.login');
    }

    // Proses Login Karyawan
    public function loginKaryawan(Request $request)
    {
        $request->validate([
            'npp' => 'required'
        ], [
            'npp.required' => 'NPP wajib diisi!'
        ]);

        $karyawan = Karyawan::where('npp', $request->npp)->first();

        if (!$karyawan) {
            return back()->with('error', 'NPP tidak ditemukan dalam sistem!');
        }

        // Simpan session login karyawan
        session([
            'karyawan_id' => $karyawan->id,
            'karyawan_npp' => $karyawan->npp
        ]);

        // Arahkan ke beranda (Di beranda akan dicek: jika belum registrasi wajah -> alihkan ke registrasi)
        return redirect()->route('karyawan.beranda');
    }

    // Halaman Form Login Admin
    public function showLoginAdmin()
    {
        // Jika admin sudah login, cegah akses form login admin & lempar ke dashboard
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
    
        return view('admin.login');
    }

    // Proses Login Admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'npp' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['npp' => $request->npp, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'NPP atau Password Admin salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}