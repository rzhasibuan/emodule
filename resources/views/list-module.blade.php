
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Modul - E-Modul Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{asset("fe/list-module.css")}}" rel="stylesheet"/>

</head>
<body>
<!-- Animated Background Particles -->
<x-animate-particles/>

<!-- Header -->
<x-navbar/>
<!-- Main Content -->
<main class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Daftar <span class="highlight">Modul Ajar</span></h1>
        <p class="subtitle">Temukan modul pembelajaran berdiferensiasi terbaik untuk kebutuhan Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="search-filter">
            <input type="text" class="search-input" placeholder="Cari modul...">
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="cards-grid">
        @forelse($modules as $module)
        <div class="module-card">
            <div class="card-image">
                @if($module->image)
                    <img src="{{ asset('storage/' . $module->image) }}" alt="Module Image" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    📚
                @endif
            </div>
            <div class="card-content">
                <span class="card-badge">{{ $module->category ?? 'Umum' }}</span>
                <h3 class="card-title">{{ $module->name }}</h3>
                <p class="card-description">{{ $module->description ?? 'Tidak ada deskripsi.' }}</p>
                <div class="card-meta">
                    <span>👤 {{ $module->author ?? 'Anonim' }}</span>
                    {{-- <span>⭐ 4.8 (124 review)</span> --}}{{-- Review score is not in DB --}}
                </div>
                <div class="card-actions">
                    <a class="btn-primary" href="{{route('detail.module', $module->id)}}">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center">Tidak ada modul yang tersedia saat ini.</p>
        @endforelse
    </div>

    <!-- See More Section -->
{{--    <div class="see-more-section">--}}
{{--        <button class="see-more-btn">Lihat Selengkapnya →</button>--}}
{{--    </div>--}}
</main>

<!-- Footer -->
<x-footer/>

<script>
    // Filter functionality
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
        });
    });

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const cards = document.querySelectorAll('.module-card');

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-description').textContent.toLowerCase();
            const badge = card.querySelector('.card-badge').textContent.toLowerCase();
            const author = card.querySelector('.card-meta span:first-child').textContent.toLowerCase(); // Assuming author is the first span in card-meta

            if (title.includes(searchTerm) || description.includes(searchTerm) || badge.includes(searchTerm) || author.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // See more button functionality
    document.querySelector('.see-more-btn').addEventListener('click', function() {
        alert('Fitur "Lihat Selengkapnya" akan menampilkan modul tambahan!');
    });
</script>
</body>
</html>
