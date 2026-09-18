<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <!-- Sidebar -->
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
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard</h1>
        <p class="text-xs text-gray-500 mb-6">Selamat datang, Administrator!</p>

        <!-- Cards Ringkasan Data -->
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-400">Total Data</p>
                <h3 class="text-2xl font-bold text-blue-900">{{ $totalData }}</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-400">Data Bulan Ini</p>
                <h3 class="text-2xl font-bold text-yellow-600">{{ $dataBulanIni }}</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-400">Data Tahun Ini</p>
                <h3 class="text-2xl font-bold text-teal-600">{{ $dataTahunIni }}</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-400">Status Sistem</p>
                <h3 class="text-lg font-bold text-green-600">Aktif ✓</h3>
            </div>
        </div>
    </div>
</body>
</html>