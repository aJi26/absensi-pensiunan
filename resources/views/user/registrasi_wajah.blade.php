<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Wajah Master - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between">
        <div>
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <!-- Logo Jasamarga RO3 -->
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('Logo DPJM.png') }}" alt="Logo Jasamarga RO3" class="h-5 w-auto object-contain">
                </div>
                <span class="text-xs font-bold text-gray-700">Registrasi Wajah</span>
            </div>

            <!-- Banner Instruksi -->
            <div class="bg-blue-50 border border-blue-200 p-3 rounded-2xl mb-4 text-xs text-blue-900">
                <p class="font-bold mb-0.5">📸 Pendaftaran Sidik Wajah Master</p>
                <p class="text-[11px] leading-relaxed text-blue-800">
                    Posisikan wajah Anda <strong>tepat di tengah lingkaran</strong> dengan pencahayaan terang. Sistem akan mengunci ciri biologis wajah Anda.
                </p>
            </div>

            <!-- Status Validasi AI Real-time -->
            <div id="statusBadge" class="bg-amber-100 border border-amber-300 text-amber-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs flex items-center justify-center gap-2 transition-all duration-300">
                <span class="animate-spin">⏳</span> Memuat AI & Kamera...
            </div>

            <!-- Frame Kamera Live -->
            <div class="relative w-72 h-72 mx-auto rounded-3xl overflow-hidden border-4 border-blue-900 shadow-lg mb-4 bg-black flex items-center justify-center">
                <video id="webcam" autoplay playsinline class="w-full h-full object-cover transform -scale-x-100"></video>
                <canvas id="canvas" class="hidden"></canvas>
                
                <!-- Bingkai Oval Panduan -->
                <div id="guideFrame" class="absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-6 pointer-events-none transition-all duration-300"></div>
            </div>

            <p class="text-center text-[11px] text-gray-400 mb-6">Pastikan seluruh bagian wajah berada penuh di dalam lingkaran.</p>

            <!-- Tombol Simpan -->
            <button type="button" id="submitBtn" onclick="takeSnapshot()" disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-not-allowed">
                <span id="btnText">🔒 Posisikan Wajah di Tengah Lingkaran</span>
            </button>
        </div>

        <div class="text-center pb-2">
            <p class="text-[10px] text-gray-400">PT Jasamarga</p>
        </div>
    </div>

    <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const statusBadge = document.getElementById('statusBadge');
        const guideFrame = document.getElementById('guideFrame');

        const MODEL_URL = 'https://cdn.jsdelivr.net/gh/cgarciagl/face-api.js@0.22.2/weights';
        let isFaceValid = false;

        navigator.mediaDevices.getUserMedia({
            video: { facingMode: "user", width: { ideal: 640 }, height: { ideal: 640 } }
        }).then(stream => {
            video.srcObject = stream;
            loadModels();
        }).catch(err => {
            statusBadge.className = "bg-red-100 border border-red-300 text-red-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
            statusBadge.innerText = "❌ Gagal Akses Kamera! Izinkan akses kamera HP Anda.";
        });

        async function loadModels() {
            try {
                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
                
                statusBadge.className = "bg-blue-100 border border-blue-300 text-blue-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
                statusBadge.innerText = "🤖 Arahkan Wajah Anda ke Dalam Lingkaran";

                setInterval(detectFaceStrict, 300);

            } catch (err) {
                statusBadge.className = "bg-red-100 border border-red-300 text-red-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
                statusBadge.innerText = "❌ Gagal Memuat Model AI";
            }
        }

        async function detectFaceStrict() {
            if (!video.videoWidth || !video.videoHeight) return;

            const detections = await faceapi.detectAllFaces(video).withFaceLandmarks();

            if (detections.length === 0) {
                setValidationStatus(false, "🔴 Wajah Tidak Terdeteksi", "Posisikan wajah Anda di depan kamera");
                return;
            }

            if (detections.length > 1) {
                setValidationStatus(false, "🔴 Ada Lebih Dari 1 Wajah!", "Pastikan hanya Anda seorang diri");
                return;
            }

            const face = detections[0];
            const box = face.detection.box;
            const score = face.detection.score;

            if (score < 0.80) {
                setValidationStatus(false, "🔴 Pencahayaan Kurang / Wajah Buram", "Cari tempat terang dan jangan bergerak");
                return;
            }

            const margin = 15;
            if (box.x < margin || box.y < margin || 
               (box.x + box.width) > (video.videoWidth - margin) || 
               (box.y + box.height) > (video.videoHeight - margin)) {
                setValidationStatus(false, "🟡 Wajah Terpotong di Pinggir!", "Geser wajah tepat ke TENGAH lingkaran");
                return;
            }

            const faceCenterX = box.x + (box.width / 2);
            const faceCenterY = box.y + (box.height / 2);
            const frameCenterX = video.videoWidth / 2;
            const frameCenterY = video.videoHeight / 2;

            const maxOffsetX = video.videoWidth * 0.18;
            const maxOffsetY = video.videoHeight * 0.18; 

            if (Math.abs(faceCenterX - frameCenterX) > maxOffsetX || Math.abs(faceCenterY - frameCenterY) > maxOffsetY) {
                setValidationStatus(false, "🟡 Wajah Belum di Tengah Lingkaran", "Arahkan muka pas di tengah lingkaran kuning");
                return;
            }

            const faceRatio = box.width / video.videoWidth;
            if (faceRatio < 0.32) {
                setValidationStatus(false, "🟡 Terlalu Jauh!", "Dekatkan wajah Anda ke kamera");
                return;
            }
            if (faceRatio > 0.70) {
                setValidationStatus(false, "🟡 Terlalu Dekat!", "Mundurkan sedikit wajah Anda");
                return;
            }

            setValidationStatus(true, "🟢 Posisi & Cahaya Sempurna!", "📸 Simpan Foto Referensi Master");
        }

        function setValidationStatus(valid, badgeMsg, btnMsg) {
            isFaceValid = valid;
            statusBadge.innerText = badgeMsg;

            if (valid) {
                statusBadge.className = "bg-emerald-100 border border-emerald-300 text-emerald-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs animate-pulse";
                guideFrame.className = "absolute inset-0 border-4 border-emerald-500 rounded-full m-6 pointer-events-none transition-all duration-300 shadow-[0_0_20px_rgba(16,185,129,0.7)]";
                submitBtn.disabled = false;
                submitBtn.className = "w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer";
                btnText.innerText = btnMsg;
            } else {
                statusBadge.className = "bg-amber-100 border border-amber-300 text-amber-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
                guideFrame.className = "absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-6 pointer-events-none transition-all duration-300";
                submitBtn.disabled = true;
                submitBtn.className = "w-full bg-gray-300 text-gray-500 font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-not-allowed";
                btnText.innerText = btnMsg;
            }
        }

        async function takeSnapshot() {
            if (!isFaceValid) return;

            submitBtn.disabled = true;
            btnText.innerText = "⏳ Memproses Sidik Wajah Digital & Menyimpan...";

            // Ekstrak Vektor 128-D Langsung dari Kamera Live
            const fullDetection = await faceapi.detectSingleFace(video)
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!fullDetection) {
                alert("Wajah terlepas dari kamera! Silakan posisikan wajah kembali.");
                submitBtn.disabled = false;
                return;
            }

            const descriptorArray = Array.from(fullDetection.descriptor);

            const context = canvas.getContext('2d');
            canvas.width = 400;
            canvas.height = 400;
            context.translate(canvas.width, 0);
            context.scale(-1, 1);
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            const imageData = canvas.toDataURL('image/jpeg', 0.85);

            fetch("/karyawan/registrasi-wajah/store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ 
                    image: imageData,
                    descriptor: descriptorArray
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert("Gagal: " + data.message);
                    submitBtn.disabled = false;
                    btnText.innerText = "📸 Simpan Foto Referensi Master";
                }
            })
            .catch(err => {
                alert("Error Server: " + err);
                submitBtn.disabled = false;
            });
        }
    </script>
</body>
</html>