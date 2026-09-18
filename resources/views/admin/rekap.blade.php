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
            <div class="flex items-center gap-2 mb-8 border-b border-blue-800 pb-4">
                <div class="bg-yellow-400 text-blue-900 font-bold px-2 py-1 rounded text-xs">RO3</div>
                <span class="text-xs font-semibold">PT Jasamarga Transjawa Tol</span>
            </div>
            <nav class="space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-blue-900 rounded">🏠 Dashboard</a>
                <a href="{{ route('admin.rekap') }}" class="block p-2 bg-blue-800 rounded font-bold">📄 Rekap</a>
                <a href="{{ route('admin.cetak') }}" class="block p-2 hover:bg-blue-900 rounded">🖨️ Cetak Laporan</a>
                <a href="{{ route('admin.edit') }}" class="block p-2 hover:bg-blue-900 rounded">✏️ Edit Data</a>
            </nav>
        </div>
    </div>

    <div class="flex-1 p-8">
        <h1 class="text-xl font-bold text-gray-800 mb-6">1. Rekap Data</h1>

        <div class="grid grid-cols-2 gap-6">
            <!-- Rekap Bulanan -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 mb-1">1.1 Rekap Bulanan</h3>
                <p class="text-xs text-gray-400 mb-6">Download rekap data berdasarkan bulan saat ini.</p>
                <div class="flex gap-3">
                    <a href="{{ route('admin.export.excel', ['bulan' => date('m')]) }}" class="bg-emerald-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-emerald-700">📊 Bentuk Excel</a>
                    <a href="{{ route('admin.export.pdf', ['bulan' => date('m')]) }}" class="bg-rose-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-rose-700">📄 Bentuk PDF</a>
                </div>
            </div>

            <!-- Rekap Tahunan -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 mb-1">1.2 Rekap Tahunan</h3>
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