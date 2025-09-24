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

<!-- KONTEN -->
@yield("content")
<!-- Scripts -->
@stack('scripts')
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
    // init pertama (removed for direct embedding in module-flipbook.blade.php)
    // If other pages still use dynamic loading, this part should be re-evaluated.
    // For module-flipbook.blade.php, we directly embed the _df_book.

    $(document).ready(function() {
        // Initialize directly embedded dFlip books
        const initDFlip = () => {
            if (window.DFLIP && typeof DFLIP.parseBooks === 'function') {
                const flipbooks = DFLIP.parseBooks();
                if (flipbooks && flipbooks.length > 0) {
                    const flipbook = flipbooks[0];
                    // Trigger fullscreen after a short delay to ensure it's fully rendered
                    setTimeout(() => {
                        if (flipbook && typeof flipbook.toggleFullscreen === 'function') {
                            flipbook.toggleFullscreen();
                        }
                    }, 1000); // 1 second delay
                }
            }
        };

        if (document.querySelector('._df_book')) {
            // Try to initialize immediately
            initDFlip();
            // Fallback for timing issues, try again after a short delay
            setTimeout(initDFlip, 500);
        }
    });
</script>
</body>
</html>
