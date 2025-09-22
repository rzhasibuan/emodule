<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Modul - E-Modul Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{asset("fe/detail-module.css")}}" rel="stylesheet"/>

</head>
<body>
<!-- Header -->
<x-navbar/>


<!-- Main Container -->
<main class="main-container">

    <!-- Top Section -->
    <div class="top-section">
        <!-- Left Box - Visual Area -->
        <div class="visual-area">
            <!--<div class="ball-3d"></div>-->
            <h2 class="visual-title">Mengenal Bola</h2>
            <p class="visual-subtitle">Konsep Dasar Geometri</p>
        </div>

        <!-- Right Box - Details Area -->
        <div class="details-area">
            <h3 class="details-title">Detail Modul</h3>

            <div class="detail-line">
                <span class="detail-label">Jenjang:</span>
                <span class="detail-value">SD Negeri 001 Bonai Darussalam</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Mata Pelajaran:</span>
                <span class="detail-value">Matematika</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Fase/Kelas:</span>
                <span class="detail-value"><span class="badge">C/5-6</span></span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Topik:</span>
                <span class="detail-value">Konsep Dasar Bola</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Sub Topik:</span>
                <span class="detail-value">Mengenal bola, menghitung volume dan luas permukaan</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Pertemuan:</span>
                <span class="detail-value"><span class="badge">1 (Satu)</span></span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Alokasi Waktu:</span>
                <span class="detail-value">2×35 Menit</span>
            </div>
        </div>
    </div>

    <!-- Bottom Section - Control Buttons -->
    <div class="bottom-section">
        <button class="control-button" onclick="handleAction('modul')">
            <div class="button-icon">📚</div>
            <div class="button-text">Perpose</div>
        </button>

        <button class="control-button" onclick="handleAction('lkpd')">
            <div class="button-icon">📝</div>
            <div class="button-text">Meterial</div>
        </button>

        <button class="control-button" onclick="handleAction('bahan')">
            <div class="button-icon">📖</div>
            <div class="button-text">Video</div>
        </button>

        <button class="control-button" onclick="handleAction('observasi')">
            <div class="button-icon">📊</div>
            <div class="button-text">Evaluation</div>
        </button>

        <button class="control-button" onclick="handleAction('download')">
            <div class="button-icon">📥</div>
            <div class="button-text">Download</div>
        </button>
    </div>
</main>


<script>
    // Handle button actions
    function handleAction(action) {
        const actions = {
            'modul': 'Membuka Modul Pembelajaran...',
            'lkpd': 'Membuka Lembar Kerja Peserta Didik...',
            'bahan': 'Membuka Bahan Ajar...',
            'observasi': 'Membuka Form Observasi...',
            'download': 'Memulai Download...'
        };

        alert(actions[action] || 'Aksi tidak dikenal');

        // Add visual feedback
        const button = event.target.closest('.control-button');
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
            button.style.transform = '';
        }, 150);
    }

    // Add interactive ball effect
    const ball = document.querySelector('.ball-3d');
    ball.addEventListener('click', function() {
        this.style.animation = 'none';
        setTimeout(() => {
            this.style.animation = 'float 1s ease-in-out 3';
        }, 100);
    });

    // Add hover effect to visual area
    const visualArea = document.querySelector('.visual-area');
    visualArea.addEventListener('mouseenter', function() {
        ball.style.transform = 'scale(1.1)';
    });

    visualArea.addEventListener('mouseleave', function() {
        ball.style.transform = 'scale(1)';
    });
</script>
</body>
</html>
