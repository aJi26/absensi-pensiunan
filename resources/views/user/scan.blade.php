<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otentikasi Face Recognition - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between pb-16">
        <div>
            <!-- Header -->
            <div class="relative flex items-center justify-center mb-6 min-h-[32px]">
                <a href="{{ route('karyawan.beranda') }}" class="absolute left-0 text-gray-600 text-xl font-bold hover:text-blue-900 transition">
                    &larr;
                </a>
                <h1 class="font-bold text-sm text-gray-800">Otentikasi Presensi</h1>
                <div class="absolute right-0 flex items-center">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-5 w-auto object-contain">
                </div>
            </div>

            <!-- Status Live Scanning & Box Peringatan AI -->
            <div id="aiStatus" class="bg-blue-50 border border-blue-200 p-3.5 rounded-2xl mb-4 flex items-center gap-3 text-xs text-blue-900 shadow-sm transition-all duration-300">
                <span id="statusIcon" class="animate-spin text-xl shrink-0">🤖</span>
                <div>
                    <p id="statusTitle" class="font-bold">Menyiapkan AI & Sidik Wajah Master...</p>
                    <p id="statusDesc" class="text-[10px] text-blue-700">Tatap layar HP Anda, verifikasi berjalan otomatis.</p>
                </div>
            </div>

            <!-- Banner Peringatan Merah (Default Tersembunyi) -->
            <div id="warningAlert" class="hidden bg-red-600 text-white p-3 rounded-2xl mb-4 text-center font-bold text-xs shadow-lg animate-bounce">
                🚨 PERINGATAN KETAT: WAJAH TIDAK COCOK!
                <p class="text-[10px] font-normal mt-0.5 text-red-100">Bukan pemilik akun terdaftar. Sistem menolak verifikasi ini.</p>
            </div>

            <!-- Frame Kamera Live -->
            <div class="relative w-64 h-64 mx-auto rounded-3xl overflow-hidden border-4 border-blue-900 shadow-xl mb-4 bg-black flex items-center justify-center">
                <video id="webcam" autoplay playsinline class="w-full h-full object-cover transform -scale-x-100"></video>
                <canvas id="canvas" class="hidden"></canvas>
                
                <!-- Bingkai Oval AI -->
                <div id="scanBorder" class="absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-5 pointer-events-none transition-all duration-300"></div>
            </div>

            <!-- Badge Presentase & Status Kemiripan Real-time -->
            <div class="text-center mb-4">
                <span id="matchScoreBadge" class="inline-block bg-gray-100 border border-gray-300 text-gray-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                    Menganalisis Ciri Biologis Wajah...
                </span>
            </div>

            <div class="bg-amber-50 border border-amber-200 p-3 rounded-xl text-center text-[11px] text-amber-800 font-semibold">
                💡 <strong>Otentikasi Ketat 1:1:</strong> Hanya pemilik asli NPP <strong>{{ $karyawan->npp }}</strong> yang akan diterima oleh AI.
            </div>
        </div>

        <div class="text-center pb-4">
            <p class="text-[10px] text-gray-400">PT Jasamarga</p>
        </div>
    </div>

    <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const aiStatus = document.getElementById('aiStatus');
        const statusIcon = document.getElementById('statusIcon');
        const statusTitle = document.getElementById('statusTitle');
        const statusDesc = document.getElementById('statusDesc');
        const scanBorder = document.getElementById('scanBorder');
        const matchScoreBadge = document.getElementById('matchScoreBadge');
        const warningAlert = document.getElementById('warningAlert');

        let referenceDescriptor = null;
        let isProcessing = false;
        let isSubmitting = false;
        let scanInterval = null;
        let matchConsecutiveCount = 0;
        const STRICT_THRESHOLD = 0.38; // Threshold verifikasi ketat fintek
        const MODEL_URL = 'https://cdn.jsdelivr.net/gh/cgarciagl/face-api.js@0.22.2/weights';

        // Ambil Vektor Master Langsung Dari Database
        const rawDescriptor = @json($karyawan->face_descriptor ? json_decode($karyawan->face_descriptor) : null);

        navigator.mediaDevices.getUserMedia({
            video: { facingMode: "user", width: { ideal: 640 }, height: { ideal: 640 } }
        }).then(stream => {
            video.srcObject = stream;
            initAI();
        }).catch(err => {
            showError("Kamera Tidak Ditemukan", "Pastikan izin kamera aktif pada browser HP Anda.");
        });

        async function initAI() {
            try {
                if (!rawDescriptor) {
                    showError("Vektor Wajah Tidak Ada", "Silakan hubungi Admin untuk Reset Foto & Registrasi Ulang.");
                    return;
                }

                referenceDescriptor = new Float32Array(rawDescriptor);

                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

                aiStatus.className = "bg-blue-50 border border-blue-200 p-3.5 rounded-2xl mb-4 flex items-center gap-3 text-xs text-blue-900 shadow-sm";
                statusIcon.innerText = "🤖";
                statusTitle.innerText = "🔍 Memverifikasi Wajah Anda...";
                statusDesc.innerText = "Posisikan wajah Anda tepat di dalam lingkaran.";

                scanInterval = setInterval(autoVerifyFaceStrict, 300);

            } catch (err) {
                showError("Gagal Memuat AI", err.message);
            }
        }

        async function autoVerifyFaceStrict() {
            if (isProcessing || isSubmitting || !referenceDescriptor || !video.videoWidth) return;

            const liveDetection = await faceapi.detectSingleFace(video)
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (liveDetection) {
                const distance = faceapi.euclideanDistance(referenceDescriptor, liveDetection.descriptor);
                const matchPercent = Math.max(0, Math.min(100, Math.round((1 - (distance / 0.65)) * 100)));

                // 1. JIKA WAJAH BERBEDA / BUKAN PEMILIK AKUN (JARAK > 0.38)
                if (distance > STRICT_THRESHOLD) {
                    matchConsecutiveCount = 0;

                    // Tampilkan Banner Peringatan Merah Nyala
                    warningAlert.classList.remove('hidden');

                    matchScoreBadge.className = "inline-block bg-red-100 border border-red-400 text-red-800 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-md animate-pulse";
                    matchScoreBadge.innerText = `⛔ WAJAH TIDAK DIKENALI (${matchPercent}% Cocok)`;

                    aiStatus.className = "bg-red-50 border-2 border-red-500 p-3.5 rounded-2xl mb-4 flex items-center gap-3 text-xs text-red-900 shadow-md";
                    statusIcon.innerText = "🚨";
                    statusTitle.innerText = "PERINGATAN: WAJAH BERBEDA!";
                    statusDesc.innerText = "Wajah dalam kamera BUKAN pemilik akun terdaftar.";
                    scanBorder.className = "absolute inset-0 border-4 border-red-600 rounded-full m-5 pointer-events-none shadow-[0_0_25px_rgba(220,38,38,0.8)]";
                    return;
                }

                // 2. JIKA WAJAH PEMILIK ASLI (JARAK <= 0.38)
                warningAlert.classList.add('hidden'); // Sembunyikan peringatan
                matchConsecutiveCount++;

                matchScoreBadge.className = "inline-block bg-emerald-100 border border-emerald-300 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm";
                matchScoreBadge.innerText = `🟢 Wajah Cocok (${matchPercent}%) - Verifikasi ${matchConsecutiveCount}/3`;

                aiStatus.className = "bg-emerald-50 border border-emerald-300 p-3.5 rounded-2xl mb-4 flex items-center gap-3 text-xs text-emerald-900 shadow-sm";
                statusIcon.innerText = "✅";
                statusTitle.innerText = "✓ Wajah Teridentifikasi Pemilik Asli!";
                statusDesc.innerText = "Tahan posisi wajah Anda...";
                scanBorder.className = "absolute inset-0 border-4 border-emerald-500 rounded-full m-5 pointer-events-none shadow-[0_0_20px_rgba(16,185,129,0.8)]";

                if (matchConsecutiveCount >= 3) {
                    isProcessing = true;
                    isSubmitting = true;
                    if (scanInterval) clearInterval(scanInterval);

                    matchScoreBadge.innerText = `✅ Terverifikasi 100% Sah!`;
                    statusTitle.innerText = "💾 Menyimpan Presensi Bulan Ini...";

                    submitAttendanceAutomatically();
                }
            } else {
                warningAlert.classList.add('hidden');
                matchConsecutiveCount = 0;
                matchScoreBadge.className = "inline-block bg-gray-100 border border-gray-300 text-gray-500 text-xs font-bold px-3 py-1 rounded-full shadow-sm";
                matchScoreBadge.innerText = "Mencari Wajah...";
                scanBorder.className = "absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-5 pointer-events-none transition-all duration-300";
            }
        }

        function submitAttendanceAutomatically() {
            const context = canvas.getContext('2d');
            canvas.width = 400;
            canvas.height = 400;
            context.translate(canvas.width, 0);
            context.scale(-1, 1);
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            const imageData = canvas.toDataURL('image/jpeg', 0.85);

            fetch("/karyawan/scan-store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ image: imageData })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('karyawan.success') }}";
                } else {
                    alert("Gagal: " + data.message);
                    isProcessing = false;
                    isSubmitting = false;
                }
            })
            .catch(err => {
                alert("Error Koneksi Server: " + err);
                isProcessing = false;
                isSubmitting = false;
            });
        }

        function showError(title, msg) {
            aiStatus.className = "bg-red-50 border border-red-200 p-3.5 rounded-2xl mb-4 text-xs text-red-800";
            statusTitle.innerText = "❌ " + title;
            statusDesc.innerText = msg;
        }
    </script>
</body>
</html>