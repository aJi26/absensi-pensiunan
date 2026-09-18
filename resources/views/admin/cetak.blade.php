<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - Admin</title>
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
                <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-blue-900 rounded">🏠 Dashboard</a>
                <a href="{{ route('admin.rekap') }}" class="block p-2 hover:bg-blue-900 rounded">📄 Rekap</a>
                <a href="{{ route('admin.cetak') }}" class="block p-2 bg-blue-800 rounded font-bold">🖨️ Cetak Laporan</a>
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
        <h1 class="text-xl font-bold text-gray-800 mb-6">2. Cetak (Laporan)</h1>

        <!-- Filter -->
        <form action="{{ route('admin.cetak') }}" method="GET" class="flex gap-4 mb-6 bg-white p-4 rounded-xl border border-gray-200">
            <div>
                <label class="block text-xs font-semibold mb-1">Pilih Bulan</label>
                <select name="bulan" class="border rounded p-2 text-sm">
                    <option value="">-- Semua Bulan --</option>
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Tahun</label>
                <input type="number" name="tahun" value="{{ $tahun }}" class="border rounded p-2 text-sm w-24">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded">🔍 Tampilkan</button>
            </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-100 text-xs text-gray-600 border-b">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">NPP</th>
                        <th class="p-3">Tampak Hasil Potret Wajah</th>
                        <th class="p-3">Tanggal Pengisian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekaps as $index => $item)
                    <tr class="border-b text-xs">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3 font-semibold">{{ $item->karyawan->nama }}</td>
                        <td class="p-3">{{ $item->karyawan->npp }}</td>
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-10 h-10 object-cover rounded-full border">
                        </td>
                        <td class="p-3">{{ $item->tanggal_pengisian->format('d M Y H:i') }} WIB</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-400 text-xs">Belum ada data rekap untuk periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>