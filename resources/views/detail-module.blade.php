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

        <button class="control-button" onclick="window.location.href='{{ asset('storage/' . $module->file) }}'">
            <div class="button-icon">📥</div>
            <div class="button-text">Perpose</div>
        </button>

        @if($module->file)
        <button class="control-button" onclick="window.location.href='{{ asset('storage/' . $module->file) }}'">
            <div class="button-icon">📥</div>
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
            <button class="control-button" onclick="window.open('{{ route('module.flipbook', $module->id) }}', '_blank')">
                <div class="button-icon">📚</div>
                <div class="button-text">Simulation</div>
            </button>
        @endif

        @if($module->file)
        <button class="control-button" onclick="window.location.href='{{ asset('storage/' . $module->file) }}'">
            <div class="button-icon">📥</div>
            <div class="button-text">Evaluation</div>
        </button>
        @endif

    </div>
</main>


<script>
</script>
</body>
</html>
