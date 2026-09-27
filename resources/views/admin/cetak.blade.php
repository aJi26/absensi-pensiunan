<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Absensi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    
    <!-- Sidebar Left -->
    <div class="w-64 bg-blue-950 min-h-screen p-4 text-white flex flex-col justify-between">
        <div>
            <div class="flex justify-center items-center mb-8 border-b border-blue-800/60 pb-4">
                <div class="bg-white px-4 py-2.5 rounded-xl shadow-sm flex items-center justify-center w-full max-w-[200px]">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-8 w-auto object-contain">
                </div>
            </div>

            <nav class="space-y-1.5 text-xs font-medium"> 
                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- 2. Data Registrasi Wajah AI -->
                <a href="{{ route('admin.karyawan') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.karyawan') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Data Registrasi</span>
                </a>

                <!-- 3. Cetak Absensi -->
                <a href="{{ route('admin.cetak') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.cetak') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak Absensi</span>
                </a>

                <!-- 4. Rekap -->
                <a href="{{ route('admin.rekap') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.rekap') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Rekap</span>
                </a>

                <!-- 5. Edit Data Karyawan -->
                <a href="{{ route('admin.edit') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.edit') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Kelola Karyawan</span>
                </a>
            </nav>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="pt-4 border-t border-blue-900/60">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-rose-600/20 hover:bg-rose-600 text-rose-300 hover:text-white border border-rose-500/30 font-semibold text-xs transition-all duration-200 group shadow-sm">
                <svg class="w-4 h-4 shrink-0 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Logout Sesi</span>
            </button>
        </form>
    </div>

    <!-- Content Area Utama -->
    <div class="flex-1 p-8">
        
        <h1 class="text-xl font-bold text-gray-800 mb-6">Cetak Laporan Absensi</h1>

        <!-- 1. CARD FILTER ATAS (Search Kiri, Filter Bulan/Tahun Kanan) -->
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-end gap-4">
            
            <!-- SISI KIRI: Search Realtime -->
            <div class="w-full md:w-80">
                <label class="block text-xs font-semibold text-gray-600 mb-1">Cari Data Absensi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 text-xs">
                        🔍
                    </span>
                    <input type="text" 
                           id="searchInput" 
                           oninput="filterRekap()" 
                           placeholder="Ketik NPP, Nama, atau Ahli Waris..." 
                           class="w-full bg-gray-50 border border-gray-300 rounded-xl pl-10 pr-4 py-2 text-xs focus:outline-none focus:border-blue-900 focus:bg-white transition shadow-sm">
                </div>
            </div>

            <!-- SISI KANAN: Filter Bulan & Tahun -->
            <form action="{{ route('admin.cetak') }}" method="GET" class="flex flex-wrap items-end gap-3 justify-end w-full md:w-auto">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Pilih Bulan</label>
                    <select name="bulan" class="bg-gray-50 border border-gray-300 rounded-xl p-2 text-xs focus:outline-none focus:border-blue-900 focus:bg-white transition cursor-pointer">
                        <option value="">-- Semua Bulan --</option>
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ $tahun }}" class="bg-gray-50 border border-gray-300 rounded-xl p-2 text-xs w-24 focus:outline-none focus:border-blue-900 focus:bg-white transition">
                </div>

                <div>
                    <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm flex items-center gap-1.5 h-[34px]">
                        🔍 Tampilkan
                    </button>
                </div>
            </form>

        </div>

        <!-- 2. CARD TABEL DATA ABSENSI -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-[11px] uppercase tracking-wider border-b border-gray-200">
                        <th class="p-4 text-center">No</th>
                        <th class="p-4">NPP</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4 text-center">Tampak Hasil Potret Wajah</th>
                        <th class="p-4">Tanggal Pengisian</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                    @forelse($rekaps as $index => $item)
                        @php
                            $karyawan = $item->karyawan;
                            $rawTipe = strtolower(trim($karyawan->tipe_keanggotaan ?? $karyawan->tipe ?? ''));
                            $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
                        @endphp

                        <tr class="rekap-row hover:bg-blue-50/40 transition" 
                            data-search="{{ strtolower(($karyawan->npp ?? '') . ' ' . ($karyawan->nama ?? '') . ' ' . ($karyawan->nama_ahli_waris ?? '')) }}">
                            
                            <!-- No -->
                            <td class="p-4 text-center font-medium">{{ $index + 1 }}</td>
                            
                            <!-- NPP -->
                            <td class="p-4 font-bold text-blue-900">{{ $karyawan->npp ?? '-' }}</td>
                            
                            <!-- Nama -->
                            <td class="p-4">
                                <span class="font-bold text-gray-800">{{ $karyawan->nama ?? '-' }}</span>
                                @if($isAhliWaris && $karyawan->nama_ahli_waris)
                                    <div class="mt-1">
                                        <span class="inline-block bg-teal-100 text-teal-800 text-[10px] font-bold px-2 py-0.5 rounded-md border border-teal-200">
                                            Ahli Waris : {{ $karyawan->nama_ahli_waris }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            
                            <!-- Foto Scan -->
                            <td class="p-4 text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Scan" class="w-10 h-10 rounded-full object-cover mx-auto border shadow-sm">
                                @else
                                    <span class="text-gray-400 italic text-[10px]">No Pic</span>
                                @endif
                            </td>
                            
                            <!-- Tanggal Pengisian -->
                            <td class="p-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengisian)->locale('id')->isoFormat('D MMM Y, HH:mm') }} WIB
                            </td>
                            
                            <!-- Aksi Cetak -->
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.cetak.individual', $item->id) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-1.5 rounded-xl text-xs transition shadow-sm inline-block">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 text-xs">
                                Belum ada data presensi untuk periode ini.
                            </td>
                        </tr>
                    @endforelse

                    <!-- Row saat pencarian tidak ditemukan -->
                    <tr id="notFoundRow" class="hidden">
                        <td colspan="6" class="p-8 text-center text-gray-400 text-xs">
                            🔍 Data presensi tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- JavaScript Filter Realtime -->
    <script>
        function filterRekap() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.rekap-row');
            const notFoundRow = document.getElementById('notFoundRow');

            let visibleCount = 0;

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search') || '';
                if (searchData.includes(keyword)) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });

            if (notFoundRow) {
                if (visibleCount === 0 && rows.length > 0) {
                    notFoundRow.classList.remove('hidden');
                } else {
                    notFoundRow.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>