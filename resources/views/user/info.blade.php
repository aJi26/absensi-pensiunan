@php
    $rawTipe = strtolower(trim($karyawan->tipe_keanggotaan ?? ''));
    $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <!-- Mobile Container -->
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between pb-20">
        <div class="p-6">
            
            <!-- 1. Header Navigation -->
            <div class="relative flex items-center justify-center mb-6 min-h-[32px]">
                <a href="{{ route('karyawan.beranda') }}" class="absolute left-0 text-gray-600 text-xl font-bold hover:text-blue-900 transition">
                    &larr;
                </a>
                <h1 class="font-bold text-sm text-gray-800">
                    {{ $isAhliWaris ? 'Profil Ahli Waris' : 'Profil Karyawan' }}
                </h1>
                <div class="absolute right-0 flex items-center">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-5 w-auto object-contain">
                </div>
            </div>

            <!-- 2. Avatar / Foto Referensi -->
            <div class="flex flex-col items-center my-6">
                <div class="w-24 h-24 rounded-full border-4 {{ $isAhliWaris ? 'border-teal-700' : 'border-blue-900' }} shadow-md overflow-hidden bg-gray-100 flex items-center justify-center mb-3">
                    @if($karyawan->foto_referensi)
                        <img src="{{ asset('storage/' . $karyawan->foto_referensi) }}" alt="Foto Profile" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl text-gray-400">👤</span>
                    @endif
                </div>
                <h2 class="font-bold text-lg text-gray-800">{{ $karyawan->nama }}</h2>
                <span class="{{ $isAhliWaris ? 'bg-teal-50 text-teal-800 border-teal-200' : 'bg-blue-50 text-blue-900 border-blue-200' }} text-[11px] font-semibold px-3 py-0.5 rounded-full border mt-1 uppercase tracking-wide">
                    {{ $isAhliWaris ? 'Ahli Waris' : 'Karyawan / Pensiunan' }}
                </span>
            </div>

            <!-- 3. Kartu Biodata Polos -->
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4 mb-6">
                
                <!-- Nama Lengkap -->
                <div class="border-b border-gray-200 pb-3">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Nama Pensiunan</p>
                    <p class="text-xs font-bold text-gray-800">{{ $karyawan->nama }}</p>
                </div>

                <!-- Nomor Pokok Pegawai (NPP) -->
                <div class="border-b border-gray-200 pb-3">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Nomor Pokok Pegawai (NPP)</p>
                    <p class="text-xs font-bold text-blue-900">{{ $karyawan->npp }}</p>
                </div>

                <!-- Tipe Akses User -->
                <div class="border-b border-gray-200 pb-3">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Tipe Akses User</p>
                    <p class="text-xs font-bold text-gray-800 capitalize">
                        {{ $isAhliWaris ? 'Ahli Waris' : 'Karyawan Aktif' }}
                    </p>
                </div>

                <!-- Nomor Telepon -->
                <div class="border-b border-gray-200 pb-3">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Nomor Telepon / WA</p>
                    <p class="text-xs font-bold text-gray-800">{{ $karyawan->no_telepon ?? '-' }}</p>
                </div>

                <!-- Status Foto Referensi AI -->
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Status Registrasi Wajah Master</p>
                    @if($karyawan->foto_referensi)
                        <span class="text-[11px] font-bold text-emerald-600 flex items-center gap-1">
                            ✓ Terdaftar (Terdeteksi Aktif)
                        </span>
                    @else
                        <span class="text-[11px] font-bold text-amber-600 flex items-center gap-1">
                            ⚠️ Belum Terdaftar
                        </span>
                    @endif
                </div>

            </div>

            <!-- 4. Kartu Status Keanggotaan -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm mb-6">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold tracking-wider uppercase">Tipe Keanggotaan</p>
                        <span class="inline-block mt-1 px-3 py-1 text-xs font-extrabold rounded-full {{ $isAhliWaris ? 'bg-teal-100 text-teal-800' : 'bg-blue-100 text-blue-900' }}">
                            {{ $isAhliWaris ? 'Ahli Waris' : 'Karyawan' }}
                        </span>
                    </div>
                    @if($isAhliWaris)
                        <div class="text-right">
                            <p class="text-[10px] text-slate-400 font-bold">Nama Ahli Waris</p>
                            <p class="text-xs font-bold text-slate-800">{{ $karyawan->nama_ahli_waris ?? '-' }} ({{ $karyawan->hubungan_ahli_waris ?? '-' }})</p>
                            <p class="text-[10px] font-semibold text-teal-700">{{ $karyawan->no_hp_ahli_waris ?? '-' }}</p>
                        </div>
                    @endif
                </div>

                @if(!$isAhliWaris)
                    <hr class="my-3 border-slate-100">
                    <a href="{{ route('karyawan.beralih.form') }}" class="w-full flex items-center justify-between bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-800 p-3 rounded-xl transition">
                        <div class="flex items-center gap-2">
                            <span class="text-base">📋</span>
                            <div class="text-left">
                                <p class="text-xs font-bold">Pelaporan Almarhum</p>
                                <p class="text-[10px] text-rose-600">Beralih status presensi ke Ahli Waris</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold">&rarr;</span>
                    </a>
                @endif
            </div>

            <!-- Unit Kerja Info -->
            <div class="mt-6 text-center">
                <p class="text-[10px] font-semibold text-gray-400">Unit Kerja:</p>
                <p class="text-xs font-bold text-gray-700">PT Jasamarga</p>
            </div>

            <!-- 5. TOMBOL LOGOUT -->
            <form action="{{ route('karyawan.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 font-bold py-3.5 rounded-2xl text-xs transition shadow-sm flex items-center justify-center gap-2">
                    🚪 Logout / Keluar Sesi
                </button>
            </form>

        </div>

        <!-- Bottom Navigation Bar -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t flex justify-around py-2 text-center text-[10px] text-gray-400 z-50">
            <a href="{{ route('karyawan.beranda') }}" class="hover:text-blue-900">
                <div class="text-base">🏠</div>
                <span>Beranda</span>
            </a>
            <a href="{{ route('karyawan.riwayat') }}" class="hover:text-blue-900">
                <div class="text-base">📄</div>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('karyawan.info') }}" class="text-blue-900 font-bold">
                <div class="text-base">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>