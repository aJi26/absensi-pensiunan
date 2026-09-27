<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password Admin - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-slate-200">
        <div class="text-center mb-6">
            <h1 class="text-xl font-extrabold text-blue-900">🔑 Lupa Password Admin</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan email terdaftar untuk menerima link reset password.</p>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 p-3 rounded-xl text-xs mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border border-rose-300 text-rose-800 p-3 rounded-xl text-xs mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Admin</label>
                <input type="email" name="email" required placeholder="admin@jasamarga.co.id" class="w-full text-xs p-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                @error('email') <span class="text-rose-600 text-[11px]">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-xl text-xs shadow-md transition">
                📧 Kirim Link Reset Password
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('admin.login') }}" class="text-xs text-slate-500 hover:text-blue-900 font-semibold">&larr; Kembali ke Login Admin</a>
        </div>
    </div>
</body>
</html>