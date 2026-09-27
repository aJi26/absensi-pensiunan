<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User; // Menggunakan Model User bawaan Laravel
use Carbon\Carbon;

class AdminPasswordResetController extends Controller
{
    // 1. Tampilkan Form Minta Email
    public function showForgotForm()
    {
        return view('admin.auth.forgot-password');
    }

    // 2. Kirim Email Link Reset Password
    public function sendResetLink(Request $request)
    {
        // PERBAIKAN: Mengarahkan pengecekan ke tabel 'users'
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email admin tidak terdaftar dalam sistem.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.'
        ]);

        $token = Str::random(64);

        // Simpan Token ke Tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $resetLink = route('admin.password.reset', ['token' => $token, 'email' => $request->email]);

        // Kirim Email Link Reset
        Mail::send('admin.emails.reset-password', ['resetLink' => $resetLink], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Admin - RO3 Jasamarga');
        });

        return redirect()->back()->with('success', 'Link reset password berhasil dikirim ke email Anda!');
    }

    // 3. Tampilkan Form Input Password Baru
    public function showResetForm(Request $request, $token)
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // 4. Update Password Baru
    public function updatePassword(Request $request)
    {
        // PERBAIKAN: Mengarahkan pengecekan ke tabel 'users'
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Cek Ketersediaan Token
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return redirect()->back()->with('error', 'Token reset password tidak valid atau sudah kadaluarsa.');
        }

        // Update Password Admin di tabel users
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Hapus Token dari Database
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')->with('success', 'Password berhasil diperbarui! Silakan login kembali.');
    }
}