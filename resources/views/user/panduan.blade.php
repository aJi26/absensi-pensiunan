<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Penggunaan - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between pb-16">
        <div>
            <!-- Header & Back Button -->
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('karyawan.beranda') }}" class="text-gray-600 text-xl font-bold hover:text-blue-900">&larr;</a>
                <span class="font-bold text-sm text-gray-800">Panduan Penggunaan</span>
                <div class="bg-blue-900 text-yellow-400 px-2 py-0.5 rounded text-xs font-bold">RO3</div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-3 bg-gray-50 p-3 rounded-2xl border">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-yellow-400 font-bold text-xs flex items-center justify-center shrink-0">1</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800 mb-1">Login dengan NPP</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed">Masukkan Nomor Pokok Pegawai (NPP) Anda pada halaman login utama.</p>
                    </div>
                </div>

                <div class="flex gap-3 bg-gray-50 p-3 rounded-2xl border">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-yellow-400 font-bold text-xs flex items-center justify-center shrink-0">2</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800 mb-1">Verifikasi Informasi</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed">Periksa kembali data nama dan NPP Anda, lalu tekan tombol **Scan Foto**.</p>
                    </div>
                </div>

                <div class="flex gap-3 bg-gray-50 p-3 rounded-2xl border">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-yellow-400 font-bold text-xs flex items-center justify-center shrink-0">3</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800 mb-1">Pengambilan Foto Wajah</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed">Izinkan akses kamera, posisikan wajah di dalam bingkai, lalu tekan tombol potret bundar.</p>
                    </div>
                </div>

                <div class="flex gap-3 bg-gray-50 p-3 rounded-2xl border">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-yellow-400 font-bold text-xs flex items-center justify-center shrink-0">4</div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800 mb-1">Selesai & Cek Riwayat</h4>
                        <p class="text-[11px] text-gray-500 leading-relaxed">Sistem akan secara otomatis menyimpan foto dan memperbarui tanggal pengisian Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <div class="fixed bottom-0 left-0 right-0 w-full max-w-md mx-auto bg-white border-t flex justify-around py-2 text-center text-[10px] text-gray-400">
            <a href="{{ route('karyawan.beranda') }}" class="hover:text-blue-900">
                <div class="text-base">🏠</div>
                <span>Beranda</span>
            </a>
            <a href="{{ route('karyawan.riwayat') }}" class="hover:text-blue-900">
                <div class="text-base">📄</div>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('karyawan.panduan') }}" class="text-blue-900 font-bold">
                <div class="text-base">📖</div>
                <span>Panduan</span>
            </a>
            <a href="{{ route('karyawan.info') }}" class="hover:text-blue-900">
                <div class="text-base">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>