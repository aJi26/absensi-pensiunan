<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Dokumentasi - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between pb-16">
        <div>
            <!-- Header & Back Button -->
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('karyawan.beranda') }}" class="text-gray-600 text-xl font-bold hover:text-blue-900">&larr;</a>
                <span class="font-bold text-sm text-gray-800">Riwayat Presensi</span>
                <div class="bg-blue-900 text-yellow-400 px-2 py-0.5 rounded text-xs font-bold">RO3</div>
            </div>

            <!-- Daftar Riwayat -->
            <div class="space-y-3">
                @forelse($rekaps as $item)
                <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 object-cover rounded-xl border">
                        <div>
                            <h4 class="font-bold text-xs text-gray-800">Presensi Wajah</h4>
                            <p class="text-[10px] text-gray-400">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengisian)->format('d M Y | H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-lg">
                        Sukses
                    </span>
                </div>
                @empty
                <div class="text-center py-12 text-gray-400">
                    <div class="text-3xl mb-2">📄</div>
                    <p class="text-xs">Belum ada riwayat presensi tersimpan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <div class="fixed bottom-0 left-0 right-0 w-full max-w-md mx-auto bg-white border-t flex justify-around py-2 text-center text-[10px] text-gray-400">
            <a href="{{ route('karyawan.beranda') }}" class="hover:text-blue-900">
                <div class="text-base">🏠</div>
                <span>Beranda</span>
            </a>
            <a href="{{ route('karyawan.riwayat') }}" class="text-blue-900 font-bold">
                <div class="text-base">📄</div>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('karyawan.panduan') }}" class="hover:text-blue-900">
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