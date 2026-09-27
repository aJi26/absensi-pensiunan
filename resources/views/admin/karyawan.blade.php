<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Registrasi Wajah AI - Admin RO3 Jasamarga</title>
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
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.karyawan') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.karyawan') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Data Registrasi</span>
                </a>

                <a href="{{ route('admin.cetak') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.cetak') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak Absensi</span>
                </a>

                <a href="{{ route('admin.rekap') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.rekap') ? 'bg-blue-800 text-white font-bold shadow-md' : 'text-blue-200/80 hover:bg-blue-900/60 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Rekap</span>
                </a>

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
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Data Registrasi Wajah</h1>
                <p class="text-xs text-gray-500 font-medium">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
        </div>

        <!-- Card Baris Atas & Input Pencarian -->
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full max-w-md">
                <label class="block text-xs font-semibold text-gray-600 mb-1">Cari Data Karyawan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 text-sm">
                        🔍
                    </span>
                    <input type="text" id="searchInput" oninput="filterKaryawan()" placeholder="Ketik NPP atau Nama Karyawan untuk mencari..." class="w-full bg-gray-50 border border-gray-300 rounded-xl pl-10 pr-4 py-2 text-xs focus:outline-none focus:border-blue-900 focus:bg-white transition shadow-sm">
                </div>
            </div>
            <div class="text-xs text-gray-500 font-semibold w-full sm:w-auto text-right">
                Total Karyawan: <strong id="totalCount" class="text-blue-900 font-bold text-sm">{{ $karyawans->count() }}</strong>
            </div>
        </div>

        <!-- Tabel Data Registrasi Wajah -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse" id="karyawanTable">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-[11px] uppercase tracking-wider border-b border-gray-200">
                        <th class="p-4">Foto Registrasi</th>
                        <th class="p-4">NPP & Nama</th>
                        <th class="p-4">Tipe Keanggotaan</th>
                        <th class="p-4">No. Telepon</th>
                        <th class="p-4">Status Registrasi</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                    @forelse($karyawans as $item)
                        @php
                            $rawTipe = strtolower(trim($item->tipe_keanggotaan ?? $item->tipe ?? ''));
                            $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
                        @endphp
                        <tr class="karyawan-row hover:bg-blue-50/40 transition" data-search="{{ strtolower($item->nama . ' ' . $item->npp . ' ' . ($item->nama_ahli_waris ?? '')) }}">
                            <!-- Preview Foto Registrasi -->
                            <td class="p-4">
                                @if($item->foto_referensi)
                                    <div class="w-12 h-12 rounded-xl overflow-hidden border-2 {{ $isAhliWaris ? 'border-teal-700' : 'border-blue-900' }} shadow-sm bg-gray-100 cursor-pointer hover:scale-105 transition transform" onclick="openModal('{{ asset('storage/' . $item->foto_referensi) }}', '{{ $item->nama }}')">
                                        <img src="{{ asset('storage/' . $item->foto_referensi) }}" alt="Foto Ref" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 border border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-[10px] font-bold">
                                        No Pic
                                    </div>
                                @endif
                            </td>

                            <!-- NPP & Nama -->
                            <td class="p-4">
                                <p class="font-bold text-gray-900 text-sm">{{ $item->nama }}</p>
                                <p class="text-blue-900 font-semibold text-[11px]">NPP: {{ $item->npp }}</p>
                                @if($isAhliWaris && $item->nama_ahli_waris)
                                    <p class="text-[10px] font-semibold text-teal-700 mt-0.5">
                                        👥 Ahli Waris: {{ $item->nama_ahli_waris }} ({{ $item->hubungan_ahli_waris ?? '-' }})
                                    </p>
                                @endif
                            </td>

                            <!-- Tipe Keanggotaan -->
                            <td class="p-4">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $isAhliWaris ? 'bg-teal-100 text-teal-800 border-teal-200' : 'bg-blue-100 text-blue-900 border-blue-200' }}">
                                    {{ $isAhliWaris ? '👥 Ahli Waris' : '👤 Karyawan' }}
                                </span>
                            </td>

                            <!-- No Telepon -->
                            <td class="p-4 text-gray-600">
                                {{ $isAhliWaris ? ($item->no_hp_ahli_waris ?? $item->no_telepon ?? '-') : ($item->no_telepon ?? '-') }}
                            </td>

                            <!-- Status Registrasi -->
                            <td class="p-4">
                                @if($item->foto_referensi)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Terdaftar
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Belum Regis
                                    </span>
                                @endif
                            </td>

                            <!-- Tombol Aksi -->
                            <td class="p-4 text-center">
                                @if($item->foto_referensi)
                                    <form action="{{ route('admin.karyawan.reset_wajah', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto registrasi {{ $item->nama }}? Karyawan/Ahli Waris harus mendaftarkan ulang foto wajahnya.')">
                                        @csrf
                                        <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200 px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                            🔄 Reset Foto Wajah
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-[10px] italic">Belum ada foto</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="6" class="p-8 text-center text-gray-400">
                                Data karyawan belum tersedia.
                            </td>
                        </tr>
                    @endforelse

                    <tr id="notFoundRow" class="hidden">
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            🔍 Data karyawan tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal Popup Zoom Foto -->
    <div id="photoModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center relative shadow-2xl">
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 font-bold text-lg">&times;</button>
            <h3 id="modalTitle" class="font-bold text-sm text-gray-800 mb-4">Foto Master Registrasi</h3>
            <div class="w-56 h-56 mx-auto rounded-2xl overflow-hidden border-4 border-blue-900 shadow-md mb-4 bg-black">
                <img id="modalImg" src="" alt="Zoom Foto" class="w-full h-full object-cover">
            </div>
            <button onclick="closeModal()" class="w-full bg-blue-900 text-white font-bold py-2 rounded-xl text-xs">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function filterKaryawan() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.karyawan-row');
            const notFoundRow = document.getElementById('notFoundRow');
            const totalCount = document.getElementById('totalCount');
            
            let visibleCount = 0;

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                if (searchData.includes(keyword)) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });

            if (totalCount) {
                totalCount.innerText = visibleCount;
            }

            if (notFoundRow) {
                if (visibleCount === 0 && rows.length > 0) {
                    notFoundRow.classList.remove('hidden');
                } else {
                    notFoundRow.classList.add('hidden');
                }
            }
        }

        function openModal(imgSrc, nama) {
            document.getElementById('modalImg').src = imgSrc;
            document.getElementById('modalTitle').innerText = "Foto Referensi: " + nama;
            document.getElementById('photoModal').classList.remove('hidden');
            document.getElementById('photoModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('photoModal').classList.add('hidden');
            document.getElementById('photoModal').classList.remove('flex');
        }
    </script>
</body>
</html>