<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between p-6">
        <div>
            <a href="{{ route('welcome') }}" class="text-gray-500 text-xl font-bold mb-6 inline-block">&larr;</a>
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="bg-blue-900 text-yellow-400 px-3 py-1 rounded-lg font-bold">RO3</div>
            </div>

            <h2 class="text-center font-bold text-lg text-gray-800 mb-1">Login Karyawan</h2>
            <p class="text-center text-xs text-gray-500 mb-8">Masukkan NPP Anda untuk melanjutkan.</p>

            @if(session('error'))
                <div class="bg-red-100 text-red-600 text-xs p-3 rounded-lg mb-4">{{ session('error') }}</div>
            @endif

            <form action="{{ route('karyawan.login') }}" method="POST">
                @csrf
                <label class="block text-xs font-semibold text-gray-600 mb-1">NPP</label>
                <input type="text" name="npp" placeholder="Contoh: NPP001" required class="w-full border rounded-lg p-3 text-sm mb-6 focus:outline-none focus:ring-2 focus:ring-blue-800">

                <button type="submit" class="w-full bg-blue-900 text-white font-bold py-3 rounded-lg text-sm shadow hover:bg-blue-800 transition">Lanjut &rarr;</button>
            </form>
        </div>

        <div class="text-center text-xs text-gray-400 italic">PT Jasamarga Transjawa Tol</div>
    </div>
</body>
</html>