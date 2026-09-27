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

    <!-- Content Area -->
    <div class="flex-1 p-8">

        <!-- Title & Action Buttons (Tambah, Import Excel, Export Excel) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Kelola Data Karyawan</h1>
                <p class="text-xs text-gray-400">Tambah, ubah, hapus, serta import/export data karyawan via Excel.</p>
            </div>

            <!-- Group Tombol Aksi Excel & Tambah -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Tombol Export Excel -->
                <a href="{{ route('admin.karyawan.export_excel') }}" 
                   class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3.5 py-2 rounded-lg shadow-sm flex items-center gap-1.5 transition">
                    📊 Export Excel
                </a>

                <!-- Tombol Import Excel -->
                <button onclick="toggleImportModal()" 
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-3.5 py-2 rounded-lg shadow-sm flex items-center gap-1.5 transition">
                    📥 Import Excel
                </button>

                <!-- Tombol Tambah Manual -->
                <button onclick="toggleModal()" 
                        class="bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs px-3.5 py-2 rounded-lg shadow-sm flex items-center gap-1.5 transition">
                    ➕ Tambah Karyawan Baru
                </button>
            </div>
        </div>

        <!-- Alert Success / Error -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 text-xs p-3 rounded-lg mb-4 border border-green-200">{{ session('success') }}</div>
        @endif

        <!-- Alert Error Validasi Lengkap -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 text-xs p-3 rounded-xl mb-4">
                <p class="font-bold mb-1">⚠️ Gagal memproses data:</p>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                        <th class="p-3">Tipe Keanggotaan</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawans as $index => $item)
                    @php
                        $rawTipe = strtolower(trim($item->tipe_keanggotaan ?? $item->tipe ?? ''));
                        $isAhliWaris = in_array($rawTipe, ['ahli waris', 'ahli_waris', 'ahli-waris']);
                    @endphp
                    <tr class="border-b text-xs hover:bg-gray-50">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3 font-semibold text-blue-900">{{ $item->npp }}</td>
                        
                        <form action="{{ route('admin.karyawan.update', $item->id) }}" method="POST">
                            @csrf
                            <td class="p-3">
                                <!-- Input Form Nama Pensiunan -->
                                <input type="text" name="nama" value="{{ $item->nama }}" required class="border rounded px-2 py-1 text-xs w-full focus:ring-1 focus:ring-blue-800">
                                
                                <!-- Badge Pill Ahli Waris di Bawah Nama Input -->
                                @if($isAhliWaris && $item->nama_ahli_waris)
                                    <div class="mt-1.5">
                                        <span class="inline-block bg-teal-100 text-teal-800 text-[10px] font-bold px-3 py-0.5 rounded-sm border border-teal-200 shadow-sm">
                                            Ahli Waris : {{ $item->nama_ahli_waris }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="p-3">
                                <input type="text" 
                                    name="no_telepon" 
                                    value="{{ $isAhliWaris ? ($item->no_hp_ahli_waris ?? $item->no_telepon) : $item->no_telepon }}" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                    maxlength="15"
                                    placeholder="08xxxxxxxxxx"
                                    class="border rounded px-2 py-1 text-xs w-full focus:ring-1 focus:ring-blue-800">
                            </td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $isAhliWaris ? 'bg-teal-100 text-teal-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $isAhliWaris ? 'Ahli Waris' : 'Karyawan' }}
                                </span>
                            </td>
                            <td class="p-3 text-center flex justify-center items-center gap-2">
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
                                
                                <!-- Dropdown Switch Status -->
                                <form action="{{ route('admin.karyawan.updateTipe', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="tipe" onchange="this.form.submit()" 
                                            class="text-xs font-semibold px-2 py-1 rounded-lg border cursor-pointer transition-all duration-200 {{ $isAhliWaris ? 'bg-teal-50 text-teal-700 border-teal-300 hover:bg-teal-100' : 'bg-blue-50 text-blue-700 border-blue-300 hover:bg-blue-100' }}">
                                        <option value="Karyawan" {{ !$isAhliWaris ? 'selected' : '' }}>👤 Karyawan</option>
                                        <option value="Ahli Waris" {{ $isAhliWaris ? 'selected' : '' }}>👥 Ahli Waris</option>
                                    </select>
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

    <!-- Modal Form Tambah Data (Manual) -->
    <div id="addModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-sm text-gray-800">Tambah Data Karyawan Baru</h3>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
            </div>
            <form action="{{ route('admin.karyawan.store') }}" method="POST">
                @csrf
                <div class="space-y-3 text-xs mb-6">
                    <!-- Input NPP (Hanya Angka) -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">NPP (Min. 5 Digit Angka)</label>
                        <input type="text" 
                            name="npp" 
                            placeholder="Contoh: 07690" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                            maxlength="15" 
                            required 
                            class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>

                    <!-- Input Nama Lengkap -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" 
                            name="nama" 
                            placeholder="Masukkan nama karyawan" 
                            required 
                            class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>

                    <!-- Input No. Telepon (Hanya Angka) -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">No. Telepon (Min. 10 Digit Angka)</label>
                        <input type="text" 
                            name="no_telepon" 
                            placeholder="Contoh: 081234567890" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                            maxlength="15" 
                            class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                    </div>

                    <!-- Input Tipe Akses -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Tipe Akses</label>
                        <select name="tipe" class="w-full border rounded-lg p-2.5 focus:outline-none focus:ring-1 focus:ring-blue-900">
                            <option value="Karyawan">Karyawan</option>
                            <option value="Ahli Waris">Ahli Waris</option>
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

    <!-- Modal Form Import Excel (Dengan Tombol Download Template) -->
    <div id="importModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl border border-gray-100 relative">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-sm text-gray-800">Import Data Karyawan (Excel)</h3>
                <button onclick="toggleImportModal()" class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
            </div>

            <!-- Tombol Download Template Excel -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 mb-4 flex items-center justify-between text-xs">
                <div>
                    <p class="font-bold text-blue-900">Belum punya template?</p>
                    <p class="text-[10px] text-blue-700">Unduh format Excel resmi untuk pengisian.</p>
                </div>
                <a href="{{ route('admin.karyawan.download_template') }}" 
                class="bg-blue-900 hover:bg-blue-800 text-white font-bold px-3 py-1.5 rounded-lg text-[11px] transition shadow-sm flex items-center gap-1 shrink-0">
                    📄 Unduh Template
                </a>
            </div>

            <form action="{{ route('admin.karyawan.import_excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Pilih File Excel (.xlsx / .xls)</label>
                    <input type="file" 
                        name="file_excel" 
                        accept=".xlsx, .xls" 
                        required 
                        class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border rounded-xl p-1 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-2">
                        * Hanya menerima format spreadsheet Excel (.xlsx / .xls).
                    </p>
                </div>

                <div class="flex gap-2">
                    <button type="button" onclick="toggleImportModal()" class="w-1/2 bg-gray-100 text-gray-600 font-bold py-2 rounded-lg text-xs">Batal</button>
                    <button type="submit" class="w-1/2 bg-emerald-600 text-white font-bold py-2 rounded-lg text-xs hover:bg-emerald-700 transition">Upload & Import</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script>
        function toggleModal() {
            const modal = document.getElementById('addModal');
            modal.classList.toggle('hidden');
        }

        function toggleImportModal() {
            const modal = document.getElementById('importModal');
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>