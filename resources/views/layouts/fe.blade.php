<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'green module')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DFlip -->
    <link href="{{asset("dflip/css/dflip.min.css")}}" rel="stylesheet" />
    <link href="{{asset("dflip/css/themify-icons.min.css")}}" rel="stylesheet" />
    <script>
        // enable dark mode via class
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors">
<!-- NAVBAR -->
<nav id="navbar"
     class="sticky top-0 z-50 backdrop-blur bg-white/80 dark:bg-gray-900/70 border-b border-gray-200/60 dark:border-gray-800
              transition-shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="h-16 flex items-center justify-between">
            <!-- Kiri: Logo -->
            <div class="flex items-center gap-3">
                <button id="mobileMenuBtn" class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Toggle menu">
                    <!-- icon burger -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <a href="#" class="flex items-center gap-2 font-semibold">
                    <span class="inline-block w-8 h-8 rounded-xl bg-teal-600"></span>
                    <span>
                        {{env("APP_NAME") ?? "Green Module"}}
                    </span>
                </a>
            </div>

            <!-- Tengah: Links desktop -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="index.html" class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">Home</a>
                <div class="relative group">
                    <button class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center gap-1 focus:outline-none">
                        Module
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-900 rounded-lg shadow-lg border border-gray-200 dark:border-gray-800 opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition-opacity z-10">
                        <a href="#" data-source="example-assets/books/intro.pdf" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 module-preview-link">📘 Modul 1: Pengenalan</a>
                        <a href="#" data-source="example-assets/books/proposal.pdf" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 module-preview-link">📗 Modul 2: Panduan Praktik</a>
                        <a href="#" data-source="example-assets/books/quickref.pdf" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 module-preview-link">📕 Modul 3: Referensi Cepat</a>
                        <a href="#" data-source="example-assets/books/case-study.pdf" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 module-preview-link">📙 Modul 4: Studi Kasus</a>
                    </div>
                </div>
                <a href="/how-to-use" class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">How to use?</a>
            </div>

            <!-- Kanan: Cari & Theme -->
            <div class="flex items-center gap-2">
                <button id="themeToggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Toggle theme">
                    <!-- icon sun/moon will swap via JS -->
                    <span id="sun" class="block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 3.5a.75.75 0 01.75.75V6a.75.75 0 01-1.5 0V4.25A.75.75 0 0110 3.5zM10 14a4 4 0 100-8 4 4 0 000 8zM4.22 5.47a.75.75 0 011.06 0L6.4 6.6a.75.75 0 01-1.06 1.06L4.22 6.53a.75.75 0 010-1.06zM3.5 10a.75.75 0 01.75-.75H6a.75.75 0 010 1.5H4.25A.75.75 0 013.5 10zm10.5 0a.75.75 0 01.75-.75H16a.75.75 0 010 1.5h-1.25A.75.75 0 0114 10zm-8.64 3.4a.75.75 0 011.06 0l1.12 1.12a.75.75 0 11-1.06 1.06L4.3 14.46a.75.75 0 010-1.06zM10 14a.75.75 0 01.75.75V16a.75.75 0 01-1.5 0v-1.25A.75.75 0 0110 14zm4.3-7.4a.75.75 0 011.06 0l1.12 1.12a.75.75 0 01-1.06 1.06L14.3 7.66a.75.75 0 010-1.06z"/>
                        </svg>
                    </span>
                    <span id="moon" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu (drawer) -->
    <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-200 dark:border-gray-800">
        <div class="px-4 py-3 space-y-3">
            <a href="index.html" class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">Beranda</a>
            <a href="#tentang" class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">Tentang</a>
            <a href="#bantuan" class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">Bantuan</a>
        </div>
    </div>
</nav>
<!-- /NAVBAR -->

<!-- KONTEN -->
@yield("content")
<!-- Scripts -->
<script src="{{asset("dflip/js/libs/jquery.min.js")}}"></script>
<script src="{{asset("dflip/js/dflip.min.js")}}"></script>
<script>
    const viewerArea = document.getElementById('viewerArea');
    const moduleList = document.getElementById('moduleList');
    const searchInput = document.getElementById('search');
    const noResults = document.getElementById('noResults');
    const navbar = document.getElementById('navbar');

    // ===== Flipbook Loader (satu instance aktif) =====
    function loadFlipbook(pdfPath) {
        viewerArea.innerHTML = '';
        const bookId = 'df_book_' + Date.now();
        const wrapper = document.createElement('div');
        wrapper.className = 'rounded-lg overflow-hidden';
        wrapper.innerHTML = `
        <div class="_df_book" id="${bookId}" webgl="true" height="900" backgroundcolor="teal" source="${pdfPath}"></div>
      `;
        viewerArea.appendChild(wrapper);
        if (window.DFLIP && typeof DFLIP.parseBooks === 'function') DFLIP.parseBooks();
        else setTimeout(() => { if (window.DFLIP?.parseBooks) DFLIP.parseBooks(); }, 0);
    }
    function setActiveButton(activeBtn) {
        moduleList.querySelectorAll('button[data-source]').forEach(b => {
            if (b === activeBtn) {
                b.classList.remove('bg-white','text-gray-800','hover:bg-gray-100','dark:bg-gray-900','dark:text-gray-100','dark:hover:bg-gray-800');
                b.classList.add('bg-teal-600','text-white');
            } else {
                b.classList.remove('bg-teal-600','text-white');
                b.classList.add('bg-white','text-gray-800','hover:bg-gray-100','dark:bg-gray-900','dark:text-gray-100','dark:hover:bg-gray-800');
            }
        });
    }
    // init pertama
    (function initFirst() {
        const firstBtn = moduleList.querySelector('button[data-source]');
        if (firstBtn) { setActiveButton(firstBtn); loadFlipbook(firstBtn.dataset.source); }
    })();

    // Klik modul di sidebar
    moduleList.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-source]');
        if (!btn) return;
        setActiveButton(btn);
        loadFlipbook(btn.dataset.source);
        viewerArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    // ===== Pencarian Sidebar =====
    function applyFilter(q) {
        q = q.trim().toLowerCase();
        let visibleCount = 0;
        moduleList.querySelectorAll('button[data-source]').forEach(btn => {
            const match = btn.textContent.toLowerCase().includes(q);
            btn.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });
        noResults.classList.toggle('hidden', visibleCount !== 0);
    }
    searchInput.addEventListener('input', (e) => applyFilter(e.target.value));

    // ===== Navbar Interaksi =====
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Cari cepat di navbar (desktop & mobile) → filter sidebar
    const searchTop = document.getElementById('searchTop');
    const searchTopMobile = document.getElementById('searchTopMobile');
    function syncSearch(val) {
        searchInput.value = val;
        applyFilter(val);
    }
    searchTop?.addEventListener('input', e => syncSearch(e.target.value));
    searchTopMobile?.addEventListener('input', e => syncSearch(e.target.value));

    // Klik item modul pada navbar dropdown & mobile menu
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('nav [data-source], #mobileMenu [data-source]');
        if (!btn) return;
        // cari tombol yang sama di daftar sidebar agar state aktif konsisten
        const targetSource = btn.dataset.source;
        const matchBtn = Array.from(moduleList.querySelectorAll('button[data-source]'))
            .find(b => b.dataset.source === targetSource);
        if (matchBtn) setActiveButton(matchBtn);
        loadFlipbook(targetSource);
        viewerArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
        // auto tutup mobile drawer
        if (!mobileMenu.classList.contains('hidden')) mobileMenu.classList.add('hidden');
    });

    // Shadow saat scroll
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY > 6;
        navbar.classList.toggle('shadow-lg', scrolled);
    });

    // ===== Dark Mode Toggle =====
    const themeToggle = document.getElementById('themeToggle');
    const sun = document.getElementById('sun');
    const moon = document.getElementById('moon');
    function applyTheme(mode) {
        const root = document.documentElement;
        if (mode === 'dark') {
            root.classList.add('dark');
            sun.classList.add('hidden'); moon.classList.remove('hidden');
        } else {
            root.classList.remove('dark');
            sun.classList.remove('hidden'); moon.classList.add('hidden');
        }
        localStorage.setItem('theme', mode);
    }
    // set awal dari prefers / localStorage
    (function initTheme() {
        const saved = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(saved || (prefersDark ? 'dark' : 'light'));
    })();
    themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.contains('dark');
        applyTheme(isDark ? 'light' : 'dark');
    });

    // ===== Module Dropdown Preview =====
    document.querySelectorAll('.module-preview-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const pdfPath = link.getAttribute('data-source');
            if (typeof loadFlipbook === 'function') {
                loadFlipbook(pdfPath);
                if (typeof setActiveButton === 'function') {
                    // Optionally highlight the sidebar button
                    const moduleList = document.getElementById('moduleList');
                    if (moduleList) {
                        const matchBtn = Array.from(moduleList.querySelectorAll('button[data-source]')).find(b => b.dataset.source === pdfPath);
                        if (matchBtn) setActiveButton(matchBtn);
                    }
                }
                const viewerArea = document.getElementById('viewerArea');
                if (viewerArea) viewerArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
</body>
</html>
