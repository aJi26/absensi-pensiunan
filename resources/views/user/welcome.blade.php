<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between p-6">
        <div>
            <!-- Header Logo -->
            <div class="flex items-center justify-center gap-3 mb-6 pt-4">
                <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-16 w-auto object-contain">
            </div>

            <h1 class="text-xl font-bold text-blue-900 text-center mb-2">Verifikasi Dana Pensiun Jasamarga</h1>
            <p class="text-xs text-gray-500 text-center mb-6">Silakan pilih jenis akses untuk melanjutkan ke halaman login.</p>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-xl text-xs mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- LOGIKA MODE LOGIN DENGAN TOMBOL SWITCH -->
            @if(session('is_ahli_waris_mode'))
                <!-- MODE AHLI WARIS -->
                <a href="{{ route('karyawan.login.form', ['type' => 'ahli-waris']) }}" class="flex items-center justify-between p-4 mb-3 border border-teal-200 bg-teal-50 rounded-xl hover:bg-teal-100 transition shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-800 font-bold">👥</div>
                        <div>
                            <h3 class="font-bold text-sm text-gray-800">Login Ahli Waris</h3>
                            <p class="text-xs text-teal-700">Akun terdaftar sebagai Ahli Waris Karyawan</p>
                        </div>
                    </div>
                    <span class="text-teal-600 font-bold">&rsaquo;</span>
                </a>
                <div class="text-center mb-6">
                    <a href="{{ route('switch.mode', 'karyawan') }}" class="text-xs text-slate-600 hover:text-blue-900 font-bold underline transition inline-flex items-center gap-1">
                        🔄 Bukan Ahli Waris? Beralih ke Login Karyawan
                    </a>
                </div>
            @else
                <!-- MODE KARYAWAN -->
                <a href="{{ route('karyawan.login.form', ['type' => 'karyawan']) }}" class="flex items-center justify-between p-4 mb-3 border rounded-xl hover:bg-blue-50 transition border-gray-200">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-900 font-bold">👤</div>
                        <div>
                            <h3 class="font-bold text-sm text-gray-800">Login Karyawan</h3>
                            <p class="text-xs text-gray-400">Untuk karyawan aktif PT Jasamarga</p>
                        </div>
                    </div>
                    <span class="text-gray-400">&rsaquo;</span>
                </a>

                <!-- Link Beralih Manual ke Login Ahli Waris -->
                <div class="text-center mb-6">
                    <a href="{{ route('switch.mode', 'ahli-waris') }}" class="text-xs text-slate-500 hover:text-teal-800 font-semibold underline transition">
                        👥 Login sebagai Ahli Waris? Klik di sini
                    </a>
                </div>
            @endif

            <!-- Panduan Penggunaan -->
            <a href="{{ route('panduan') }}" class="flex items-center justify-between p-4 border border-amber-200 rounded-xl bg-amber-50/60 hover:bg-amber-100/80 transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-800 text-base">📖</div>
                    <div>
                        <h3 class="font-bold text-sm text-gray-800">Panduan Penggunaan</h3>
                        <p class="text-xs text-gray-500">Petunjuk cara otentikasi & presensi</p>
                    </div>
                </div>
                <span class="text-gray-400">&rsaquo;</span>
            </a>
        </div>

        <!-- Footer -->
        <div class="-mx-6 -mb-6 bg-blue-900 text-white py-4 px-6 text-center mt-8 rounded-t-2xl">
            <p class="text-xs italic">@07690_SUDARTO</p>
        </div>
    </div>
</body>
</html>