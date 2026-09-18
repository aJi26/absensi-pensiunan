<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="bg-blue-900 text-yellow-400 font-bold px-3 py-1 rounded">RO3</div>
        </div>
        <h2 class="text-xl font-bold text-center mb-1">Login Admin</h2>
        <p class="text-xs text-gray-500 text-center mb-6">Masukkan NPP dan password Anda.</p>

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold mb-1">NPP</label>
                <input type="text" name="npp" placeholder="ADMIN001" required class="w-full border p-2 rounded text-sm">
            </div>
            <div class="mb-6">
                <label class="block text-xs font-bold mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full border p-2 rounded text-sm">
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 rounded text-sm hover:bg-blue-800">Login &rarr;</button>
        </form>
    </div>
</body>
</html>