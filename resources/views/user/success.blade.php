<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berhasil Disimpan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between text-center">
        <div class="mt-8">
            <!-- Icon Centang Hijau -->
            <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 font-bold">✓</div>

            <h2 class="font-bold text-lg text-gray-800 mb-1">Data Berhasil Disimpan!</h2>
            <p class="text-xs text-gray-500 mb-8">Foto Anda telah berhasil direkam oleh sistem.</p>

            <div class="bg-gray-50 p-4 rounded-xl text-left mb-6">
                <label class="text-xs text-gray-400">Nama</label>
                <p class="font-semibold text-sm text-gray-800 mb-3">{{ $karyawan->nama }}</p>

                <label class="text-xs text-gray-400">NPP</label>
                <p class="font-semibold text-sm text-gray-800 mb-3">{{ $karyawan->npp }}</p>

                <label class="text-xs text-gray-400">Waktu Pengambilan Foto</label>
                <p class="font-semibold text-sm text-gray-800"> {{ \Carbon\Carbon::parse($rekap->tanggal_pengisian)->format('d F Y | H:i') }} WIB </p>
        </div>

        <a href="{{ route('karyawan.beranda') }}" class="w-full bg-blue-900 text-white font-bold py-3 rounded-lg text-sm block">🏠 Kembali ke Beranda</a>
    </div>
</body>
</html>