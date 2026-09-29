@php
    $rawTipe = strtolower(trim($karyawan->tipe_keanggotaan ?? ''));
    $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Pensiunan - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between pb-16">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <!-- Logo Jasamarga RO3 -->
                <div class="flex items-center justify-center">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-5 w-auto object-contain">
                </div>
                <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full font-bold border">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM Y') }}
                </span>
            </div>

            <!-- Salam, User & Status Badge -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-xs text-gray-500">Selamat Datang,</p>
                    <!-- Badge Status Keanggotaan -->
                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full {{ $isAhliWaris ? 'bg-teal-100 text-teal-800 border border-teal-200' : 'bg-blue-100 text-blue-900 border border-blue-200' }}">
                        {{ $isAhliWaris ? '👥 Ahli Waris' : '👤 Karyawan / Pensiunan' }}
                    </span>
                </div>
                <h2 class="font-bold text-base text-gray-800">{{ $karyawan->nama }}</h2>
                <h3 class="font-semibold text-xs text-blue-900">NPP: {{ $karyawan->npp }}</h3>

                <!-- TAMBAHAN: CARD INFORMASI AHLI WARIS (Di bawah NPP) -->
                @if($isAhliWaris)
                    <div class="mt-3 bg-teal-50/80 border border-teal-200 p-3.5 rounded-xl shadow-sm space-y-2">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-teal-900 border-b border-teal-200/60 pb-1.5">
                            <span>📋</span> Data Ahli Waris Terdaftar
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-gray-400 block text-[10px] font-semibold uppercase">Nama Ahli Waris</span>
                                <span class="font-bold text-gray-800">{{ $karyawan->nama_ahli_waris ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400 block text-[10px] font-semibold uppercase">Hubungan</span>
                                <span class="font-bold text-gray-800">{{ $karyawan->hubungan_ahli_waris ?? '-' }}</span>
                            </div>
                            <div class="col-span-2 pt-1 border-t border-teal-100">
                                <span class="text-gray-400 block text-[10px] font-semibold uppercase">No. HP / WhatsApp</span>
                                <span class="font-bold text-gray-800">{{ $karyawan->no_hp_ahli_waris ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- CARD STATUS OTENTIKASI BULANAN -->
            @if($presensiBulanIni)
                <!-- SUDAH PRESENSI BULAN INI -->
                <div class="bg-emerald-500 text-white p-5 rounded-2xl mb-6 shadow-md">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center font-bold text-base">✓</div>
                        <div>
                            <span class="bg-emerald-700 text-emerald-100 font-bold px-2 py-0.5 rounded text-[9px] uppercase tracking-wider">Status Otentikasi</span>
                            <h3 class="font-bold text-sm">Sudah Terverifikasi</h3>
                        </div>
                    </div>
                    <p class="text-[11px] text-emerald-100 leading-relaxed border-t border-emerald-400/40 pt-2 mt-2">
                        Otentikasi bulan <strong>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM Y') }}</strong> berhasil. Dana pensiun Anda siap diproses.
                    </p>
                </div>
            @else
                <!-- BELUM PRESENSI BULAN INI (TOMBOL AKTIF) -->
                <a href="{{ route('karyawan.scan') }}" class="bg-gradient-to-r from-blue-900 to-indigo-800 p-5 rounded-2xl mb-6 flex items-center justify-between text-white shadow-lg hover:opacity-95 transition block group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-400 text-blue-950 flex items-center justify-center text-2xl font-bold shadow">
                            📸
                        </div>
                        <div>
                            <span class="bg-yellow-400 text-blue-950 font-bold px-2 py-0.5 rounded text-[9px] uppercase tracking-wider mb-1 inline-block">Wajib Sebulan Sekali</span>
                            <h3 class="font-bold text-sm text-white">Presensi Otentikasi Wajah</h3>
                            <p class="text-[10px] text-blue-200">Verifikasi Keberadaan Bulan Ini</p>
                        </div>
                    </div>
                    <span class="text-white text-xl font-bold group-hover:translate-x-1 transition-transform">&rsaquo;</span>
                </a>
            @endif

            <!-- Menu Fitur Lainnya -->
            <h3 class="font-bold text-xs text-gray-700 mb-3">Menu Informasi</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('karyawan.info') }}" class="p-4 bg-gray-50 border rounded-2xl hover:bg-blue-50 transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-900 flex items-center justify-center text-sm mb-2">👤</div>
                    <h4 class="font-bold text-xs text-gray-800">Profil Saya</h4>
                </a>

                <a href="{{ route('karyawan.riwayat') }}" class="p-4 bg-gray-50 border rounded-2xl hover:bg-blue-50 transition">
                    <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-800 flex items-center justify-center text-sm mb-2">📄</div>
                    <h4 class="font-bold text-xs text-gray-800">Riwayat Presensi</h4>
                </a>
            </div>
        </div>

        <!-- Navigation Bar -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t flex justify-around py-2 text-center text-[10px] text-gray-400">
            <a href="{{ route('karyawan.beranda') }}" class="text-blue-900 font-bold">
                <div class="text-base">🏠</div>
                <span>Beranda</span>
            </a>
            @if(!$presensiBulanIni)
                <a href="{{ route('karyawan.scan') }}" class="hover:text-blue-900">
                    <div class="text-base">📸</div>
                    <span>Absensi</span>
                </a>
            @endif
            <a href="{{ route('karyawan.riwayat') }}" class="hover:text-blue-900">
                <div class="text-base">📄</div>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('karyawan.info') }}" class="hover:text-blue-900">
                <div class="text-base">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
    <script>
    // Mencegah tombol Back browser kembali ke halaman login/welcome
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    </script>
</body>
</html>