<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Modul - Platform Pembelajaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset("fe/style.css")}}" rel="stylesheet"/>
</head>
<body>

<!-- Animated Background Particles -->
<x-animate-particles/>


<!-- Decorative Elements -->
<div class="star-1">✨</div>
<div class="star-2">✨</div>
<div class="pencil-icon">✨</div>
<div class="book-icon">✨</div>


<!-- Header -->
<x-navbar/>


@yield('content')

<!-- Improved Footer -->
<x-footer/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset("dflip/js/dflip.min.js")}}"></script>
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

</script>
@stack('scripts')
</body>
</html>
