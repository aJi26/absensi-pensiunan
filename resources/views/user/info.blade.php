<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between pb-16">
        <div>
            <!-- Header & Back Button -->
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('karyawan.beranda') }}" class="text-gray-600 text-xl font-bold hover:text-blue-900">&larr;</a>
                <span class="font-bold text-sm text-gray-800">Profil Saya</span>
                <div class="bg-blue-900 text-yellow-400 px-2 py-0.5 rounded text-xs font-bold">RO3</div>
            </div>

            <!-- Card Profil -->
            <div class="bg-gray-50 p-5 rounded-2xl border mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-900 text-yellow-400 flex items-center justify-center font-bold text-xl mx-auto mb-4">
                    {{ strtoupper(substr($karyawan->nama, 0, 1)) }}
                </div>
                
                <div class="space-y-3">
                    <div>
                        <label class="text-[10px] text-gray-400 font-semibold block">Nama Lengkap</label>
                        <p class="font-bold text-sm text-gray-800">{{ $karyawan->nama }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400 font-semibold block">NPP</label>
                        <p class="font-bold text-sm text-blue-900">{{ $karyawan->npp }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400 font-semibold block">No. Telepon</label>
                        <p class="font-semibold text-xs text-gray-700">{{ $karyawan->no_telepon ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400 font-semibold block">Tipe Akses</label>
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-900 rounded-full text-[10px] font-bold inline-block">
                            {{ ucfirst($karyawan->tipe) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tombol Scan Presensi -->
            <div class="border border-blue-100 bg-blue-50/50 p-4 rounded-xl text-center">
                <p class="text-xs text-gray-600 mb-3">Lakukan pemotretan wajah untuk verifikasi data presensi.</p>
                <a href="{{ route('karyawan.scan') }}" class="block w-full bg-blue-900 text-white font-bold py-3 rounded-lg text-sm shadow hover:bg-blue-800 transition">
                    📷 Lakukan Scan Wajah &rarr;
                </a>
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
            <a href="{{ route('karyawan.panduan') }}" class="hover:text-blue-900">
                <div class="text-base">📖</div>
                <span>Panduan</span>
            </a>
            <a href="{{ route('karyawan.info') }}" class="text-blue-900 font-bold">
                <div class="text-base">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>