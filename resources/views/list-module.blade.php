
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
        <!-- Card 1 -->
        <div class="module-card">
            <div class="card-image">📚</div>
            <div class="card-content">
                <span class="card-badge">Matematika</span>
                <h3 class="card-title">Aljabar Linear untuk Pemula</h3>
                <p class="card-description">Modul pembelajaran aljabar linear yang dirancang khusus untuk siswa dengan gaya belajar yang berbeda-beda.</p>
                <div class="card-meta">
                    <span>👤 Dr. Ahmad Suharto</span>
                    <span>⭐ 4.8 (124 review)</span>
                </div>
                <div class="card-actions">
                    <a class="btn-primary" href="{{route('detail.module', 2)}}">Lihat Detail</a>
                    <button class="btn-secondary">📥</button>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="module-card">
            <div class="card-image">📖</div>
            <div class="card-content">
                <span class="card-badge">Bahasa Indonesia</span>
                <h3 class="card-title">Menulis Kreatif dengan Teknik Berdiferensiasi</h3>
                <p class="card-description">Panduan lengkap menulis kreatif yang disesuaikan dengan kemampuan dan minat siswa yang beragam.</p>
                <div class="card-meta">
                    <span>👤 Prof. Siti Nurhaliza</span>
                    <span>⭐ 4.9 (89 review)</span>
                </div>
                <div class="card-actions">
                    <button class="btn-primary">Lihat Detail</button>
                    <button class="btn-secondary">📥</button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="module-card">
            <div class="card-image">🔬</div>
            <div class="card-content">
                <span class="card-badge">IPA</span>
                <h3 class="card-title">Eksperimen Fisika Interaktif</h3>
                <p class="card-description">Modul praktikum fisika dengan pendekatan hands-on learning untuk berbagai tingkat kemampuan siswa.</p>
                <div class="card-meta">
                    <span>👤 Dr. Budi Santoso</span>
                    <span>⭐ 4.7 (156 review)</span>
                </div>
                <div class="card-actions">
                    <button class="btn-primary">Lihat Detail</button>
                    <button class="btn-secondary">📥</button>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="module-card">
            <div class="card-image">🌍</div>
            <div class="card-content">
                <span class="card-badge">IPS</span>
                <h3 class="card-title">Sejarah Nusantara Digital</h3>
                <p class="card-description">Pembelajaran sejarah Indonesia dengan teknologi AR/VR dan adaptasi untuk kebutuhan belajar individual.</p>
                <div class="card-meta">
                    <span>👤 Prof. Dewi Kartika</span>
                    <span>⭐ 4.6 (203 review)</span>
                </div>
                <div class="card-actions">
                    <button class="btn-primary">Lihat Detail</button>
                    <button class="btn-secondary">📥</button>
                </div>
            </div>
        </div>
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

            if (title.includes(searchTerm) || description.includes(searchTerm) || badge.includes(searchTerm)) {
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
