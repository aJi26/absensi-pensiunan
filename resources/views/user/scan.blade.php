<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Foto - Face Recognition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-black flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md h-screen relative flex flex-col justify-between p-6">
        <!-- Header -->
        <div class="flex justify-between items-center text-white z-10">
            <a href="{{ route('karyawan.info') }}" class="text-xl font-bold">&larr;</a>
            <span class="font-semibold text-sm">Scan Foto</span>
            <span></span>
        </div>

        <!-- Video Stream & Frame Wajah -->
        <div class="absolute inset-0 flex items-center justify-center">
            <video id="video" autoplay playsinline class="w-full h-full object-cover"></video>
            <!-- Bingkai Petunjuk Wajah -->
            <div class="absolute w-64 h-80 border-2 border-white/80 rounded-3xl pointer-events-none shadow-[0_0_0_9999px_rgba(0,0,0,0.5)]"></div>
        </div>

        <!-- Canvas Tersembunyi untuk Capture -->
        <canvas id="canvas" class="hidden"></canvas>

        <!-- Footer Controller & Instruksi -->
        <div class="z-10 text-center mb-6">
            <p class="text-white text-xs mb-6 bg-black/40 py-2 px-4 rounded-full backdrop-blur-sm inline-block">
                Pastikan wajah Anda berada di dalam kotak dan pencahayaan cukup.
            </p>
            
            <button id="snap-btn" onclick="takeSnapshot()" class="w-16 h-16 bg-white border-4 border-gray-300 rounded-full mx-auto flex items-center justify-center shadow-lg active:scale-95 transition">
                <div class="w-12 h-12 bg-white border-2 border-black rounded-full"></div>
            </button>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snapBtn = document.getElementById('snap-btn');

        // Minta izin akses kamera
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
            .then(stream => { video.srcObject = stream; })
            .catch(err => { alert('Gagal mengakses kamera: ' + err); });

        function takeSnapshot() {
            snapBtn.disabled = true;
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/png');

            // Kirim foto ke Laravel via Fetch API
            fetch("{{ route('karyawan.scan.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ image: imageData })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    window.location.href = "{{ route('karyawan.success') }}";
                } else {
                    alert(data.message);
                    snapBtn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                snapBtn.disabled = false;
            });
        }
    </script>
</body>
</html>