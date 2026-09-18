<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between pb-16">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-2">
                    <div class="bg-blue-900 text-yellow-400 px-2 py-0.5 rounded text-xs font-bold">RO3</div>
                    <span class="text-[10px] text-gray-400 font-semibold">PT Jasamarga Transjawa Tol</span>
                </div>
                <button class="text-gray-500 text-lg">🔔</button>
            </div>

            <!-- Salam & Info User -->
            <p class="text-xs text-gray-500">Selamat Datang,</p>
            <h2 class="font-bold text-sm text-gray-800 mb-4">NPP {{ $karyawan->npp }}</h2>

            <!-- Status Data Tersimpan -->
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">✓</div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-semibold">Status Data</p>
                        <h3 class="font-bold text-xs text-emerald-700">Tersimpan</h3>
                        <p class="text-[10px] text-gray-400">
                            {{ $lastRekap ? \Carbon\Carbon::parse($lastRekap->tanggal_pengisian)->format('d M Y | H:i') . ' WIB' : 'Belum ada data' }}
                        </p>
                    </div>
                </div>
                <span class="text-gray-400 text-sm">&rsaquo;</span>
            </div>

            <!-- Menu Utama -->
            <h3 class="font-bold text-xs text-gray-700 mb-3">Menu Utama</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('karyawan.info') }}" class="p-4 bg-gray-50 border rounded-2xl flex flex-col justify-between hover:bg-blue-50 transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-900 flex items-center justify-center text-sm mb-3">👤</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Profil Saya</h4>
                        <p class="text-[10px] text-gray-400">Lihat Data Pribadi</p>
                    </div>
                </a>

                <a href="{{ route('karyawan.info') }}" class="p-4 bg-gray-50 border rounded-2xl flex flex-col justify-between hover:bg-blue-50 transition">
                    <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-800 flex items-center justify-center text-sm mb-3">📄</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Riwayat</h4>
                        <p class="text-[10px] text-gray-400">Data Tersimpan</p>
                    </div>
                </a>

                <div class="p-4 bg-gray-50 border rounded-2xl flex flex-col justify-between">
                    <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-800 flex items-center justify-center text-sm mb-3">📖</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Panduan</h4>
                        <p class="text-[10px] text-gray-400">Cara Penggunaan</p>
                    </div>
                </div>

                <a href="{{ route('welcome') }}" class="p-4 bg-gray-50 border rounded-2xl flex flex-col justify-between hover:bg-red-50 transition">
                    <div class="w-8 h-8 rounded-lg bg-gray-200 text-gray-700 flex items-center justify-center text-sm mb-3">🚪</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">Keluar</h4>
                        <p class="text-[10px] text-gray-400">Logout Aplikasi</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t flex justify-around py-2 text-center text-[10px] text-gray-400">
            <a href="{{ route('karyawan.beranda') }}" class="text-blue-900 font-bold">
                <div class="text-base">🏠</div>
                <span>Beranda</span>
            </a>
            <div>
                <div class="text-base">📄</div>
                <span>Riwayat</span>
            </div>
            <div>
                <div class="text-base">📖</div>
                <span>Panduan</span>
            </div>
            <a href="{{ route('karyawan.info') }}">
                <div class="text-base">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>