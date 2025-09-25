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
@stack('scripts')
</body>
</html>
