<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Logo Jasamarga RO3 -->
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-10 w-auto object-contain">
            </div>
        <h2 class="text-xl font-bold text-center mb-1">Login Admin</h2>
        <p class="text-xs text-gray-500 text-center mb-6">Masukkan Username dan Password Anda.</p>

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold mb-1">Username</label>
                <input type="text" name="npp" placeholder="ADMIN001" required class="w-full border p-2 rounded text-sm">
            </div>
            <div class="mb-6">
                <label class="block text-xs font-bold mb-1">Password</label>
                <div class="relative flex items-center">
                    <input type="password" id="admin_password" name="password" placeholder="••••••••" required class="w-full border p-2 pr-10 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-900">
                    
                    <button type="button" onclick="togglePassword('admin_password', 'eyeOpenLogin', 'eyeCloseLogin')" class="absolute right-3 text-gray-400 hover:text-blue-900 focus:outline-none z-10">
                        <!-- Eye Open -->
                        <svg id="eyeOpenLogin" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Closed -->
                        <svg id="eyeCloseLogin" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.962 8.962 0 012.122-.363c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs text-gray-600">Lupa password?</span>
                <a href="{{ route('admin.password.request') }}" class="text-xs text-blue-900 font-bold hover:underline">
                    Lupa Password
                </a>
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 rounded text-sm hover:bg-blue-800">Login &rarr;</button>
        </form>
    </div>
    <script>
        function togglePassword(inputId, openId, closeId) {
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