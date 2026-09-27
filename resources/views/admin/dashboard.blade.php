<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - JM Jasamarga</title>
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

    <!-- Content Area -->
    <div class="flex-1 p-8">
        
        <!-- BUBBLE PROFIL ADMIN DI POJOK KANAN ATAS -->
        <div class="flex justify-between items-center mb-6 pb-2">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-xs text-gray-500 font-medium">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>

            <div class="relative">
                <button onclick="toggleProfileDropdown()" class="flex items-center gap-3 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm hover:bg-gray-50 transition cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-blue-900 text-yellow-400 flex items-center justify-center font-bold text-xs shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-xs font-bold text-gray-800 leading-none">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-gray-400 leading-none mt-1">NPP: {{ Auth::user()->npp ?? 'ADMIN001' }}</p>
                    </div>
                    <span class="text-xs text-gray-400 ml-1">▼</span>
                </button>

                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 p-3">
                    <div class="p-3 bg-blue-50/70 rounded-xl mb-2">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-blue-900 text-yellow-400 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-900 rounded-full text-[9px] font-bold inline-block">Admin RO3</span>
                            </div>
                        </div>
                        <hr class="border-blue-100 my-2">
                        <p class="text-[10px] text-gray-500"><strong>NPP:</strong> {{ Auth::user()->npp ?? '-' }}</p>
                        <p class="text-[10px] text-gray-500"><strong>Email:</strong> {{ Auth::user()->email ?? '-' }}</p>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2 p-2 text-xs text-red-600 font-bold hover:bg-red-50 rounded-lg transition">
                            🚪 Logout / Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END BUBBLE PROFIL -->

        <!-- Cards Ringkasan Data Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <!-- Card 1: Total Data -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1">Total Presensi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalData }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                    📁
                </div>
            </div>

            <!-- Card 2: Data Bulan Ini -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1">Data Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $dataBulanIni }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                    📅
                </div>
            </div>

            <!-- Card 3: Data Tahun Ini -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1">Data Tahun Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $dataTahunIni }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl shadow-inner">
                    🗓️
                </div>
            </div>

            <!-- Card 4: Status Sistem -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1">Status AI Engine</p>
                    <h3 class="text-lg font-bold text-emerald-600">Aktif (1:1)</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                    🤖
                </div>
            </div>
        </div>

        <!-- Banner Ucapan & Shortcut Fitur Utama Registrasi Wajah AI -->
            <div class="md:col-span-2 bg-blue-50/60 border border-blue-100 rounded-2xl p-6 flex items-center justify-between shadow-sm">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-1">Selamat Datang, Admin!</h2>
                    <p class="text-xs text-gray-500 max-w-lg leading-relaxed">
                        Kelola rekap, laporan, dan verifikasi foto master registrasi wajah pengguna melalui panel administrasi dengan mudah dan cepat.
                    </p>
                </div>
                <div class="hidden md:flex items-center justify-center w-20 h-20 bg-blue-100/70 rounded-full text-4xl shadow-sm">
                    👨‍💼
                </div>
            </div>
    </div>

    <script>
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = e.target.closest('button');
            if (!button) {
                if (dropdown && !dropdown.contains(e.target) && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>