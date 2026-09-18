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
            $request->validate(['npp' => 'required']);

            $karyawan = Karyawan::where('npp', $request->npp)->first();

            if (!$karyawan) {
                return back()->with('error', 'NPP tidak ditemukan dalam sistem!');
            }

            // Simpan session login karyawan
            session(['karyawan_id' => $karyawan->id, 'karyawan_npp' => $karyawan->npp]);

            return redirect()->route('karyawan.info');
        }

        // Halaman Form Login Admin
        public function showLoginAdmin()
        {
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
            return redirect('/');
        }
    }
