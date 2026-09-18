<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between p-6">
        <div>
            <!-- Header Logo -->
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-blue-900 text-yellow-400 p-2 rounded-lg font-bold text-xl">RO3</div>
                <span class="text-xs text-gray-500 font-semibold">PT Jasamarga Transjawa Tol</span>
            </div>

            <h1 class="text-xl font-bold text-blue-900 mb-1">Selamat Datang di</h1>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Sistem Dokumentasi Karyawan</h2>
            <p class="text-xs text-gray-500 mb-8">Silakan pilih jenis akses untuk melanjutkan ke halaman login.</p>

            <!-- Pilihan Login Karyawan -->
            <a href="{{ route('karyawan.login.form') }}" class="flex items-center justify-between p-4 mb-4 border rounded-xl hover:bg-blue-50 transition border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-900">👤</div>
                    <div>
                        <h3 class="font-bold text-sm text-gray-800">Login Karyawan</h3>
                        <p class="text-xs text-gray-400">Untuk karyawan aktif PT Jasamarga Transjawa Tol</p>
                    </div>
                </div>
                <span class="text-gray-400">&rsaquo;</span>
            </a>

            <!-- Pilihan Login Ahli Waris -->
            <a href="{{ route('karyawan.login.form') }}" class="flex items-center justify-between p-4 border rounded-xl hover:bg-blue-50 transition border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-800">👥</div>
                    <div>
                        <h3 class="font-bold text-sm text-gray-800">Login Ahli Waris</h3>
                        <p class="text-xs text-gray-400">Untuk ahli waris karyawan PT Jasamarga Transjawa Tol</p>
                    </div>
                </div>
                <span class="text-gray-400">&rsaquo;</span>
            </a>
        </div>

        <!-- Footer Image Banner Mockup -->
        <div class="mt-8 rounded-xl overflow-hidden bg-blue-900 text-white p-4 text-center">
            <p class="text-xs italic">Bersama Membangun Jalan untuk Negeri</p>
        </div>
    </div>
</body>
</html>