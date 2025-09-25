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
        <div class="visual-area" @if($module->image) style="background-image: url('{{ asset('storage/' . $module->image) }}'); background-size: cover; background-position: center;" @endif>
            <h2 class="visual-title">{{ $module->name }}</h2>
            <p class="visual-subtitle">{{ $module->category ?? 'Umum' }}</p>
        </div>

        <!-- Right Box - Details Area -->
        <div class="details-area">
            <h3 class="details-title">Detail Modul</h3>

            <div class="detail-line">
                <span class="detail-label">Nama Modul:</span>
                <span class="detail-value">{{ $module->name }}</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Kategori:</span>
                <span class="detail-value">{{ $module->category ?? 'Umum' }}</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Penulis:</span>
                <span class="detail-value">{{ $module->author ?? 'Anonim' }}</span>
            </div>

            <div class="detail-line">
                <span class="detail-label">Deskripsi:</span>
                <span class="detail-value">{{ $module->description ?? 'Tidak ada deskripsi.' }}</span>
            </div>

            @if($module->file)
            <div class="detail-line">
                <span class="detail-label">File Modul:</span>
                <span class="detail-value"><a href="{{ route('module.flipbook', $module->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Flipbook</a></span>
            </div>
            @endif

        </div>
    </div>

    <!-- Bottom Section - Control Buttons -->
    <div class="bottom-section">

        <button class="control-button" onclick="window.location.href=''">
            <div class="button-icon">📥</div>
            <div class="button-text">Perpose</div>
        </button>

        @if($module->file)
        <button class="control-button" onclick="window.location.href='{{ route('module.flipbook', $module->id) }}'">
            <div class="button-icon">📖</div>
            <div class="button-text">Materi</div>
        </button>
        @endif


        @if($module->link_video && count($module->link_video) > 0)
            @foreach($module->link_video as $video)
                @php
                    $href  = is_array($video) ? ($video['url'] ?? '') : $video;
                    $title = is_array($video) ? ($video['title'] ?? 'Video') : 'Video';
                @endphp
                @if($href)
                <button class="control-button" onclick="window.open('{{ $href }}', '_blank')">
                    <div class="button-icon">▶</div>
                    <div class="button-text">{{ $title }}</div>
                </button>
                @endif
            @endforeach
        @endif

        @if($module->file)
            <button class="control-button" onclick="window.open('{{ route('how-to-use') }}', '_blank')">
                <div class="button-icon">📚</div>
                <div class="button-text">Simulation</div>
            </button>
        @endif

        @if($module->file)
        <button class="control-button" onclick="window.location.href='{{ route('module.quiz.start', $module->id) }}'">
            <div class="button-icon">📝</div>
            <div class="button-text">Evaluation</div>
        </button>
        @php
            $userResult = null;
            if(Auth::check()) {
                $userResult = \App\Models\QuizResult::where('user_id', Auth::id())->where('module_id', $module->id)->latest()->first();
            }
        @endphp

        @endif

    </div>
</main>


<script>
    // Mobile Menu Toggle Functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuToggle.addEventListener('click', function() {
        mobileMenuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });

    // Close mobile menu when clicking on a link
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideNav = mobileMenuToggle.contains(event.target) || mobileMenu.contains(event.target);

        if (!isClickInsideNav && mobileMenu.classList.contains('active')) {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 900) {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });

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
    if (ball) {
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
    }
</script>
</body>
</html>
