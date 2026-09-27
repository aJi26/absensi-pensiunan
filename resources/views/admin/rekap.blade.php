<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Data - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
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

    <div class="flex-1 p-8">
        <h1 class="text-xl font-bold text-gray-800 mb-6">Rekap Data</h1>

        <div class="grid grid-cols-2 gap-6">
            <!-- Rekap Bulanan -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 mb-1">1. Rekap Bulanan</h3>
                <p class="text-xs text-gray-400 mb-6">Download rekap data berdasarkan bulan saat ini.</p>
                <div class="flex gap-3">
                    <a href="{{ route('admin.export.excel', ['bulan' => date('m')]) }}" class="bg-emerald-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-emerald-700">📊 Bentuk Excel</a>
                    <a href="{{ route('admin.export.pdf', ['bulan' => date('m')]) }}" class="bg-rose-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-rose-700">📄 Bentuk PDF</a>
                </div>
            </div>

            <!-- Rekap Tahunan -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 mb-1">2. Rekap Tahunan</h3>
                <p class="text-xs text-gray-400 mb-6">Download rekap data berdasarkan tahun berjalan.</p>
                <div class="flex gap-3">
                    <a href="{{ route('admin.export.excel') }}" class="bg-emerald-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-emerald-700">📊 Bentuk Excel</a>
                    <a href="{{ route('admin.export.pdf') }}" class="bg-rose-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-rose-700">📄 Bentuk PDF</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>