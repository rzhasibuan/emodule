@extends('layouts.fe-new')

@section('title', 'Tentang Kami - E-Modul Platform')

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="content-left">
            <h1>
                Mengenal Lebih Dekat <span class="highlight">E-Modul</span> Platform
            </h1>
            <p class="description">
                E-Modul Platform hadir sebagai solusi inovatif untuk pembelajaran berdiferensiasi. Kami berkomitmen untuk menyediakan akses mudah ke modul ajar berkualitas tinggi yang dirancang untuk memenuhi beragam gaya dan kebutuhan belajar.
            </p>

            <h2 class="text-2xl font-bold mt-6 mb-3" style="color: #fff3cd">Visi Kami</h2>
            <p class="description">
                Menjadi platform terdepan dalam memfasilitasi pendidikan yang inklusif dan adaptif, memberdayakan setiap individu untuk mencapai potensi akademis dan personal terbaiknya.
            </p>

            <h2 class="text-2xl font-bold mt-6 mb-3" style="color: #fff3cd">Misi Kami</h2>
            <ul class="list-disc list-inside description space-y-2">
                <li>Menyediakan modul ajar berdiferensiasi yang inovatif dan relevan.</li>
                <li>Memastikan aksesibilitas materi pembelajaran bagi semua kalangan.</li>
                <li>Mendukung pendidik dalam menciptakan lingkungan belajar yang dinamis dan efektif.</li>
                <li>Mendorong kolaborasi dan berbagi pengetahuan di komunitas pendidikan.</li>
            </ul>

            <p class="description mt-6">
                Kami percaya bahwa dengan teknologi dan pedagogi yang tepat, proses belajar dapat menjadi pengalaman yang lebih menarik, personal, dan efektif. Bergabunglah dengan kami dalam perjalanan membangun masa depan pendidikan!
            </p>

            <div class="cta-buttons mt-8">
                <a href="{{ route('listModule') }}" class="primary-btn" style="text-decoration: none">Jelajahi Modul Kami</a>
                <a href="{{ route('how-to-use') }}" class="secondary-btn" style="text-decoration: none">
                    <span class="play-icon">▶</span>
                    Panduan Penggunaan
                </a>
            </div>
        </div>
        <div class="content-right">
            <div class="hero-placeholder">
                <img src="{{ asset('about.png') }}" alt="Ilustrasi Tentang Kami" class="rounded-lg shadow-lg" style="width: 100%;"/>
            </div>
        </div>
    </main>
@endsection
