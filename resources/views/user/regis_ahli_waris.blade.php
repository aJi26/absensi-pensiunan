<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Wajah Ahli Waris - RO3 Jasamarga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg p-6 flex flex-col justify-between rounded-2xl border border-gray-200">
        <div>
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('karyawan.beralih.form') }}" class="text-gray-600 text-xl font-bold hover:text-blue-900">&larr; Kembali</a>
                <img src="{{ asset('Logo DPJM.png') }}" class="h-5 w-auto object-contain">
            </div>

            <div class="mb-4">
                <h2 class="text-sm font-bold text-gray-800">Registrasi Wajah Ahli Waris</h2>
                <p class="text-[11px] text-gray-500">Posisikan wajah tepat di tengah lingkaran untuk merekam vektor master.</p>
            </div>

            <!-- Status AI -->
            <div id="statusBadge" class="bg-amber-100 border border-amber-300 text-amber-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs flex items-center justify-center gap-2">
                <span class="animate-spin">⏳</span> Memuat AI & Kamera...
            </div>

            <!-- Frame Kamera Live -->
            <div class="relative w-64 h-64 mx-auto rounded-3xl overflow-hidden border-4 border-blue-900 shadow-lg mb-4 bg-black flex items-center justify-center">
                <video id="webcam" autoplay playsinline class="w-full h-full object-cover transform -scale-x-100"></video>
                <canvas id="canvas" class="hidden"></canvas>
                <div id="guideFrame" class="absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-5 pointer-events-none transition-all duration-300"></div>
            </div>

            <!-- Tombol Potret -->
            <button type="button" id="submitBtn" onclick="takeSnapshot()" disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-not-allowed">
                <span id="btnText">🔒 Posisikan Wajah Ahli Waris di Tengah Lingkaran</span>
            </button>
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
            statusBadge.innerText = "❌ Gagal Akses Kamera!";
        });

        async function loadModels() {
            try {
                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
                
                statusBadge.className = "bg-blue-100 border border-blue-300 text-blue-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
                statusBadge.innerText = "🤖 Arahkan Wajah Ahli Waris ke Dalam Lingkaran";

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
                setValidationStatus(false, "🔴 Wajah Tidak Terdeteksi", "Posisikan wajah di depan kamera");
                return;
            }

            if (detections.length > 1) {
                setValidationStatus(false, "🔴 Ada Lebih Dari 1 Wajah!", "Pastikan hanya Ahli Waris seorang diri");
                return;
            }

            const face = detections[0];
            const box = face.detection.box;
            const score = face.detection.score;

            if (score < 0.80) {
                setValidationStatus(false, "🔴 Pencahayaan Kurang / Wajah Buram", "Cari tempat terang");
                return;
            }

            setValidationStatus(true, "🟢 Posisi Sempurna!", "📸 Simpan Registrasi Wajah Ahli Waris");
        }

        function setValidationStatus(valid, badgeMsg, btnMsg) {
            isFaceValid = valid;
            statusBadge.innerText = badgeMsg;

            if (valid) {
                statusBadge.className = "bg-emerald-100 border border-emerald-300 text-emerald-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs animate-pulse";
                guideFrame.className = "absolute inset-0 border-4 border-emerald-500 rounded-full m-5 pointer-events-none transition-all duration-300 shadow-[0_0_20px_rgba(16,185,129,0.7)]";
                submitBtn.disabled = false;
                submitBtn.className = "w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer";
                btnText.innerText = btnMsg;
            } else {
                statusBadge.className = "bg-amber-100 border border-amber-300 text-amber-900 p-2.5 rounded-xl mb-4 text-center font-bold text-xs";
                guideFrame.className = "absolute inset-0 border-4 border-dashed border-amber-400 rounded-full m-5 pointer-events-none transition-all duration-300";
                submitBtn.disabled = true;
                submitBtn.className = "w-full bg-gray-300 text-gray-500 font-bold py-3.5 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 cursor-not-allowed";
                btnText.innerText = btnMsg;
            }
        }

        async function takeSnapshot() {
            if (!isFaceValid) return;

            submitBtn.disabled = true;
            btnText.innerText = "⏳ Memproses Vektor Wajah...";

            const fullDetection = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();

            if (!fullDetection) {
                alert("Wajah terlepas dari kamera!");
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

            fetch("{{ route('karyawan.beralih.regis.store') }}", {
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