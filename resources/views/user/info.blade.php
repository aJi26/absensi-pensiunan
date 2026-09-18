<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('welcome') }}" class="text-gray-500 text-xl font-bold">&larr;</a>
                <div class="bg-blue-900 text-yellow-400 px-2 py-0.5 rounded text-xs font-bold">RO3</div>
            </div>

            <h2 class="font-bold text-lg text-gray-800 mb-6">Informasi Karyawan</h2>

            <div class="bg-gray-50 p-4 rounded-xl mb-6">
                <label class="text-xs text-gray-400">Nama</label>
                <p class="font-semibold text-sm text-gray-800 mb-3">{{ $karyawan->nama }}</p>

                <label class="text-xs text-gray-400">NPP</label>
                <p class="font-semibold text-sm text-gray-800">{{ $karyawan->npp }}</p>
            </div>

            <div class="border border-blue-100 bg-blue-50/50 p-4 rounded-xl text-center mb-6">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2 text-blue-800 text-xl">📷</div>
                <p class="text-xs text-gray-600 mb-4">Silakan lakukan scan foto Anda untuk melanjutkan proses dokumentasi.</p>
                <a href="{{ route('karyawan.scan') }}" class="block w-full bg-blue-900 text-white font-bold py-3 rounded-lg text-sm shadow">📷 Scan Foto &rarr;</a>
            </div>
        </div>

        <p class="text-center text-xs text-gray-400">Data Anda akan langsung tersimpan secara otomatis di sistem.</p>
    </div>
</body>
</html>