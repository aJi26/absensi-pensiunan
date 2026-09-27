<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Ahli Waris - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="w-full max-w-md bg-white shadow-lg p-6 rounded-2xl border border-gray-200">
        <!-- Header Navigasi -->
        <div class="relative flex items-center justify-center mb-6 min-h-[32px]">
            <a href="{{ route('karyawan.info') }}" class="absolute left-0 text-gray-600 text-xl font-bold hover:text-blue-900 transition">&larr;</a>
            <span class="font-bold text-sm text-gray-800">Pelaporan Ahli Waris</span>
            <img src="{{ asset('Logo DPJM.png') }}" class="absolute right-0 h-6 w-auto object-contain">
        </div>

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-xl text-xs mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Info Karyawan Almarhum -->
        <div class="bg-blue-50 border border-blue-200 p-3.5 rounded-2xl mb-5 text-xs">
            <p class="text-blue-900 font-bold mb-0.5">📋 Data Karyawan (Almarhum)</p>
            <p class="text-blue-800 font-semibold">NPP: <span class="text-blue-950 font-bold">{{ $karyawan->npp }}</span></p>
            <p class="text-blue-800 font-semibold">Nama: <span class="text-blue-950 font-bold">{{ $karyawan->nama }}</span></p>
        </div>

        <form action="{{ route('karyawan.beralih.proses') }}" method="POST">
            @csrf
            
            <!-- Input Identitas Ahli Waris -->
            <div class="space-y-4 mb-5">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap Ahli Waris</label>
                    <input type="text" name="nama_ahli_waris" required placeholder="Sesuai KTP Penerima" class="w-full text-xs p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Hubungan Keluarga</label>
                    <select name="hubungan_ahli_waris" required class="w-full text-xs p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                        <option value="">-- Pilih Hubungan --</option>
                        <option value="Istri">Istri</option>
                        <option value="Suami">Suami</option>
                        <option value="Anak">Anak</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nomor WA / Telepon Ahli Waris</label>
                    <input type="tel" 
                           name="no_hp_ahli_waris" 
                           required 
                           minlength="10"
                           maxlength="15"
                           inputmode="numeric"
                           placeholder="Contoh: 081234567890" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, ''); validatePhone(this)"
                           class="w-full text-xs p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-900 focus:outline-none">
                    <p id="phoneError" class="text-[11px] text-rose-600 font-semibold mt-1 hidden">
                        ⚠️ Nomor HP/WA minimal harus 10 digit angka!
                    </p>
                </div>
            </div>

            <!-- Status Perekaman Wajah Ahli Waris -->
            <div class="p-4 rounded-2xl mb-6 {{ session()->has('temp_ahli_waris_face') ? 'bg-emerald-50 border border-emerald-200' : 'bg-amber-50 border border-amber-200' }}">
                <p class="text-xs font-bold mb-1 {{ session()->has('temp_ahli_waris_face') ? 'text-emerald-900' : 'text-amber-900' }}">
                    📸 Registrasi Wajah Ahli Waris
                </p>

                @if(session()->has('temp_ahli_waris_face'))
                    <p class="text-[11px] text-emerald-700 font-semibold mb-3">✅ Registrasi Wajah Ahli Waris Berhasil!</p>
                    <a href="{{ route('karyawan.beralih.regis') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-3 rounded-xl text-xs transition">
                        🔄 Ambil Ulang Foto Wajah
                    </a>
                @else
                    <p class="text-[11px] text-amber-800 mb-3">Wajah Ahli Waris wajib didaftarkan untuk presensi bulanan selanjutnya.</p>
                    <a href="{{ route('karyawan.beralih.regis') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-sm">
                        📷 Buka Kamera & Registrasi Wajah
                    </a>
                @endif
            </div>

            <!-- Tombol Simpan Utama -->
            <button type="submit" 
                    {{ !session()->has('temp_ahli_waris_face') ? 'disabled' : '' }}
                    class="w-full font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 {{ session()->has('temp_ahli_waris_face') ? 'bg-blue-900 hover:bg-blue-800 text-white cursor-pointer' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}">
                💾 Simpan & Beralih ke Ahli Waris
            </button>
        </form>
    </div>

    <script>
        function validatePhone(input) {
            const phoneError = document.getElementById('phoneError');
            if (input.value.length > 0 && input.value.length < 10) {
                phoneError.classList.remove('hidden');
            } else {
                phoneError.classList.add('hidden');
            }
        }
    </script>
</body>
</html>