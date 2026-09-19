<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <!-- Sidebar Left -->
    <div class="w-64 bg-blue-950 min-h-screen p-4 text-white flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2 mb-8 border-b border-blue-800 pb-4">
                <div class="bg-yellow-400 text-blue-900 font-bold px-2 py-1 rounded text-xs">RO3</div>
                <span class="text-xs font-semibold">PT Jasamarga Transjawa Tol</span>
            </div>
            <nav class="space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block p-2 bg-blue-800 rounded font-bold">🏠 Dashboard</a>
                <a href="{{ route('admin.rekap') }}" class="block p-2 hover:bg-blue-900 rounded">📄 Rekap</a>
                <a href="{{ route('admin.cetak') }}" class="block p-2 hover:bg-blue-900 rounded">🖨️ Cetak Laporan</a>
                <a href="{{ route('admin.edit') }}" class="block p-2 hover:bg-blue-900 rounded">✏️ Edit Data</a>
            </nav>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-600 text-xs py-2 rounded font-bold">🚪 Logout</button>
        </form>
    </div>

    <!-- Content Area -->
    <div class="flex-1 p-8">
        
        <!-- BUBBLE PROFIL ADMIN DI POJOK KANAN ATAS -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
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

        <!-- Cards Ringkasan Data Statistik (Dengans Icon) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <!-- Card 1: Total Data -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1">Total Data</p>
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
                    <p class="text-xs text-gray-400 font-medium mb-1">Status Sistem</p>
                    <h3 class="text-lg font-bold text-emerald-600">Aktif</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                    ☑️
                </div>
            </div>
        </div>

        <!-- Banner Ucapan Selamat Datang (Sesuai Mockup Gambar) -->
        <div class="bg-blue-50/60 border border-blue-100 rounded-2xl p-6 flex items-center justify-between shadow-sm">
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-1">Selamat Datang, Admin!</h2>
                <p class="text-xs text-gray-500 max-w-lg leading-relaxed">
                    Kelola rekap, laporan, dan data pengguna melalui panel administrasi dengan mudah dan cepat.
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