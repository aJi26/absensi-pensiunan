<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Karyawan</title>
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
                <a href="{{ route('admin.rekap') }}" class="block p-2 hover:bg-blue-900 rounded">📄 Rekap</a>
                <a href="{{ route('admin.cetak') }}" class="block p-2 hover:bg-blue-900 rounded">🖨️ Cetak Laporan</a>
                <a href="{{ route('admin.edit') }}" class="block p-2 bg-blue-800 rounded font-bold">✏️ Edit Data</a>
            </nav>
        </div>
    </div>

    <div class="flex-1 p-8">
        <h1 class="text-xl font-bold text-gray-800 mb-6">3. Edit Data Karyawan</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 text-xs p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm max-w-2xl">
            @foreach($karyawans as $item)
            <form action="{{ route('admin.karyawan.update', $item->id) }}" method="POST" class="border-b pb-4 mb-4">
                @csrf
                <div class="grid grid-cols-3 gap-4 mb-2">
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block">NPP</label>
                        <input type="text" value="{{ $item->npp }}" disabled class="border rounded p-2 text-xs w-full bg-gray-100">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block">Nama</label>
                        <input type="text" name="nama" value="{{ $item->nama }}" required class="border rounded p-2 text-xs w-full">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block">No. Telepon</label>
                        <input type="text" name="no_telepon" value="{{ $item->no_telepon }}" class="border rounded p-2 text-xs w-full">
                    </div>
                </div>
                <button type="submit" class="bg-blue-900 text-white text-xs font-bold px-3 py-1.5 rounded">Simpan Perubahan</button>
            </form>
            @endforeach
        </div>
    </div>
</body>
</html>