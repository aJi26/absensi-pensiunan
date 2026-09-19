<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Karyawan - Admin</title>
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
                <a href="{{ route('admin.cetak') }}" class="block p-2 hover:bg-blue-900 rounded">🖨️ Cetak Laporan</a>
                <a href="{{ route('admin.edit') }}" class="block p-2 bg-blue-800 rounded font-bold">✏️ Kelola Data</a>
            </nav>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-600 text-xs py-2 rounded font-bold">🚪 Logout</button>
        </form>
    </div>

    <!-- Content Area -->
    <div class="flex-1 p-8">
        

        <!-- Title & Action Button -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Kelola Data Karyawan</h1>
                <p class="text-xs text-gray-400">Tambah, ubah, atau hapus data karyawan/pensiunan.</p>
            </div>
            <button onclick="toggleModal()" class="bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs px-4 py-2 rounded-lg shadow-sm flex items-center gap-2">
                ➕ Tambah Karyawan Baru
            </button>
        </div>

        <!-- Alert Success / Error -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 text-xs p-3 rounded-lg mb-4 border border-green-200">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-600 text-xs p-3 rounded-lg mb-4 border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Tabel Data Karyawan -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-100 text-xs text-gray-600 border-b">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">NPP</th>
                        <th class="p-3">Nama Lengkap</th>
                        <th class="p-3">No. Telepon</th>
                        <th class="p-3">Tipe</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawans as $index => $item)
                    <tr class="border-b text-xs hover:bg-gray-50">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3 font-semibold text-blue-900">{{ $item->npp }}</td>
                        <form action="{{ route('admin.karyawan.update', $item->id) }}" method="POST">
                            @csrf
                            <td class="p-3">
                                <input type="text" name="nama" value="{{ $item->nama }}" required class="border rounded px-2 py-1 text-xs w-full focus:ring-1 focus:ring-blue-800">
                            </td>
                            <td class="p-3">
                                <input type="text" name="no_telepon" value="{{ $item->no_telepon }}" class="border rounded px-2 py-1 text-xs w-full focus:ring-1 focus:ring-blue-800">
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $item->tipe == 'karyawan' ? 'bg-blue-100 text-blue-800' : 'bg-teal-100 text-teal-800' }}">
                                    {{ ucfirst($item->tipe) }}
                                </span>
                            </td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-1 rounded text-[11px]">
                                    💾 Simpan
                                </button>
                        </form>
                                <form action="{{ route('admin.karyawan.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-3 py-1 rounded text-[11px]">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-400 text-xs">Belum ada data karyawan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form Tambah Data (Hidden default) -->
    <div id="addModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-sm text-gray-800">Tambah Data Karyawan Baru</h3>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
            </div>
            <form action="{{ route('admin.karyawan.store') }}" method="POST">
                @csrf
                <div class="space-y-3 text-xs mb-6">
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">NPP</label>
                        <input type="text" name="npp" placeholder="Contoh: NPP006" required class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama karyawan" required class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">No. Telepon</label>
                        <input type="text" name="no_telepon" placeholder="Contoh: 081234567890" class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Tipe Akses</label>
                        <select name="tipe" class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                            <option value="karyawan">Karyawan</option>
                            <option value="ahli_waris">Ahli Waris</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button" onclick="toggleModal()" class="w-1/2 bg-gray-100 text-gray-600 font-bold py-2 rounded-lg text-xs">Batal</button>
                    <button type="submit" class="w-1/2 bg-blue-900 text-white font-bold py-2 rounded-lg text-xs hover:bg-blue-800">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('addModal');
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>