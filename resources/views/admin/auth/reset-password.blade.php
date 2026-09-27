<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Baru - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-slate-200">
        <div class="text-center mb-6">
            <h1 class="text-xl font-extrabold text-blue-900">🔒 Buat Password Baru</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan password baru untuk akun Admin Anda.</p>
        </div>

        @if (session('error'))
            <div class="bg-rose-50 border border-rose-300 text-rose-800 p-3 rounded-xl text-xs mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Admin</label>
                <input type="email" value="{{ $email }}" disabled class="w-full text-xs p-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-500 font-semibold">
            </div>

            <!-- Password Baru -->
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 mb-1">Password Baru</label>
                <div class="relative flex items-center">
                    <input type="password" id="password" name="password" required placeholder="Minimal 6 Karakter" class="w-full text-xs p-3 pr-10 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                    
                    <button type="button" onclick="togglePass('password', 'eyeOpen1', 'eyeClose1')" class="absolute right-3 text-slate-400 hover:text-blue-900 focus:outline-none z-10">
                        <!-- Eye Open -->
                        <svg id="eyeOpen1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Closed -->
                        <svg id="eyeClose1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.962 8.962 0 012.122-.363c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password') <span class="text-rose-600 text-[11px]">{{ $message }}</span> @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <div class="relative flex items-center">
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi Password Baru" class="w-full text-xs p-3 pr-10 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                    
                    <button type="button" onclick="togglePass('password_confirmation', 'eyeOpen2', 'eyeClose2')" class="absolute right-3 text-slate-400 hover:text-blue-900 focus:outline-none z-10">
                        <!-- Eye Open -->
                        <svg id="eyeOpen2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Closed -->
                        <svg id="eyeClose2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.962 8.962 0 012.122-.363c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-xl text-xs shadow-md transition">
                💾 Simpan Password Baru
            </button>
        </form>
    </div>

    <script>
        function togglePass(inputId, openId, closeId) {
            const input = document.getElementById(inputId);
            const openIcon = document.getElementById(openId);
            const closeIcon = document.getElementById(closeId);

            if (input.type === 'password') {
                input.type = 'text';
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>