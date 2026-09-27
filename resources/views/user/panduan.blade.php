<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Penggunaan - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between">
        <div>
            <!-- Header Navigasi Kembali ke Welcome -->
            <div class="relative flex justify-between items-center mb-6">
            <!-- Logo Jasamarga RO3 -->
                <div class="flex items-center justify-center">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-6 w-auto object-contain">
                </div>
            
            <div class="w-8"></div>
        </div>

            <h1 class="text-xl font-bold text-center text-gray-800 mb-6">Panduan Otentikasi</h1>
            <h2 class="text-sm font-bold text-gray-800 mb-1">Petunjuk Presensi Pensiunan</h2>
            <p class="text-xs text-gray-500 mb-6">Langkah mudah verifikasi keberadaan (Proof of Life) bulanan.</p>

            <!-- Langkah-Langkah Panduan -->
            <div class="space-y-4 text-xs">
                
                <!-- Langkah 1 -->
                <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl flex gap-3 items-start">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-white font-bold flex items-center justify-center shrink-0 text-xs">
                        1
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-0.5">Pilih Akses & Masuk NPP</h3>
                        <p class="text-gray-500 leading-relaxed text-[12px]">Pada halaman awal, pilih jenis akses (Karyawan/Ahli Waris), lalu masukkan Nomor Pokok Pegawai (NPP) Anda.</p>
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl flex gap-3 items-start">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-white font-bold flex items-center justify-center shrink-0 text-xs">
                        2
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-0.5">Registrasi Wajah (Pengguna Baru)</h3>
                        <p class="text-gray-500 leading-relaxed text-[12px]">Jika baru pertama kali, sistem meminta Anda mengambil foto wajah sebagai data input. Posisikan wajah di dalam bingkai oval dengan pencahayaan terang.</p>
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl flex gap-3 items-start">
                    <div class="w-7 h-7 rounded-full bg-blue-900 text-white font-bold flex items-center justify-center shrink-0 text-xs">
                        3
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-0.5">Presensi Bulanan Otomatis</h3>
                        <p class="text-gray-500 leading-relaxed text-[12px]">Setiap sebulan sekali, buka menu <strong>Absensi</strong>. Cukup tatap kamera HP tanpa memencet tombol. AI akan otomatis memverifikasi wajah Anda.</p>
                    </div>
                </div>

                <!-- Langkah 4 -->
                <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl flex gap-3 items-start">
                    <div class="w-7 h-7 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">
                        4
                    </div>
                    <div>
                        <h3 class="font-bold text-emerald-800 mb-0.5">Pencairan Dana Pensiun</h3>
                        <p class="text-gray-500 leading-relaxed text-[12px]">Setelah terverifikasi, status di beranda akan menjadi hijau dan dana pensiun bulan berjalan siap diproses oleh pihak Jasamarga.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Section Bawah: Contact Person & Tombol Back -->
        <div class="mt-8 pb-4 space-y-4">
            
            <!-- Contact Person Help Center (Posisi Tengah / Center) -->
            <div class="text-center pt-2 border-t border-gray-100">
                <p class="text-[11px] text-gray-500 font-medium">Hubungi nomor berikut jika butuh bantuan:</p>
                <a href="https://wa.me/62818247265" target="_blank" class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-full mt-2 hover:bg-emerald-100 transition shadow-sm">
                    <span>💬</span>
                    <span>0818-247-265</span>
                </a>
            </div>

            <!-- Tombol Kembali ke Halaman Utama -->
            <a href="{{ route('welcome') }}" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3.5 rounded-2xl text-xs block text-center shadow-md transition">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>