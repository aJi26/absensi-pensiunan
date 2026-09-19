<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Dokumentasi - {{ $rekap->karyawan->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-8 flex justify-center items-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg border border-gray-200">
        <!-- Header Logo -->
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <div class="flex items-center gap-2">
                <div class="bg-blue-900 text-yellow-400 font-bold px-3 py-1 rounded text-sm">RO3</div>
                <span class="text-xs font-semibold text-gray-500">PT Jasamarga Transjawa Tol</span>
            </div>
            <button onclick="window.print()" class="no-print bg-blue-900 text-white text-xs px-3 py-1.5 rounded font-bold hover:bg-blue-800">
                🖨️ Cetak / Print
            </button>
        </div>

        <h2 class="text-center font-bold text-lg text-gray-800 mb-1">Bukti Dokumentasi Presensi</h2>
        <p class="text-center text-xs text-gray-400 mb-6">Sistem Presensi & Scan Wajah Pensiunan/Karyawan</p>

        <!-- Foto Hasil Scan -->
        <div class="flex justify-center mb-6">
            <div class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-blue-900 shadow">
                <img src="{{ asset('storage/' . $rekap->foto) }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Detail Data Karyawan -->
        <div class="bg-gray-50 p-4 rounded-xl text-xs space-y-3 mb-6">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Nama Lengkap</span>
                <span class="font-bold text-gray-800">{{ $rekap->karyawan->nama }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">NPP</span>
                <span class="font-bold text-gray-800">{{ $rekap->karyawan->npp }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">No. Telepon</span>
                <span class="font-bold text-gray-800">{{ $rekap->karyawan->no_telepon ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400">Waktu Pengisian</span>
                <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($rekap->tanggal_pengisian)->format('d F Y | H:i') }} WIB</span>
            </div>
        </div>

        <p class="text-center text-[10px] text-gray-400">Dokumen ini dicetak otomatis dari Sistem Dokumentasi Karyawan RO3 PT Jasamarga Transjawa Tol.</p>
    </div>
</body>
</html>