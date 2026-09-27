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
            <!-- Logo Jasamarga RO3 -->
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-8 w-auto object-contain">
            </div>

            <!-- Judul & Subtitle Dinamis -->
            <h2 class="text-xl font-bold text-center text-gray-900 mb-1">
                {{ isset($loginType) && $loginType === 'ahli-waris' ? 'Login Ahli Waris' : 'Login Karyawan' }}
            </h2>
            <p class="text-xs text-gray-500 text-center mb-6">
                {{ isset($loginType) && $loginType === 'ahli-waris' ? 'Masukkan NPP Pensiunan untuk verifikasi Ahli Waris.' : 'Masukkan NPP Anda untuk melanjutkan.' }}
            </p>


            <form action="{{ route('karyawan.login') }}" method="POST">
                @csrf
                
                <!-- Input Hidden Wajib untuk Mengirim Tipe Login -->
                <input type="hidden" name="login_type" value="{{ $loginType ?? 'karyawan' }}">

                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">NPP Karyawan</label>
                    <input type="text" name="npp" placeholder="Masukkan NPP" required class="w-full border p-2 rounded text-sm">
                </div>

                <!-- Tampilan Alert Error jika Ditolak Controller -->
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-xs mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 rounded text-sm hover:bg-blue-800">
                    Login &rarr;
                </button>
            </form>
        </div>

        <div class="text-center text-xs text-gray-400 italic">PT Jasamarga</div>
    </div>
</body>
</html>