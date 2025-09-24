@extends('layouts.fe-new')

@section('title', 'Panduan Penggunaan - E-Modul Platform')

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="content-left">
            <h1>
                Panduan <span class="highlight">Penggunaan</span> Aplikasi
            </h1>
            <p class="description">
                Selamat datang di panduan penggunaan E-Modul Platform! Aplikasi ini dirancang untuk mempermudah Anda dalam mengakses modul pembelajaran interaktif, mengerjakan kuis, dan melacak kemajuan belajar Anda. Ikuti langkah-langkah di bawah ini untuk memulai.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-6 mb-3">1. Menjelajahi Modul Pembelajaran</h2>
            <ul class="list-disc list-inside description space-y-2">
                <li><strong>Akses Modul:</strong> Anda dapat menemukan daftar modul pembelajaran di halaman <a href="{{ route('listModule') }}" class="text-teal-600 hover:underline">List Modul</a>.</li>
                <li><strong>Lihat Detail Modul:</strong> Klik pada judul modul atau tombol "Lihat Detail" untuk melihat informasi lebih lanjut tentang modul tersebut, termasuk deskripsi, penulis, dan kategori.</li>
                <li><strong>Melihat Modul dalam Flipbook:</strong> Pada halaman detail modul, jika tersedia, Anda dapat melihat isi modul dalam format flipbook interaktif yang nyaman.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-6 mb-3">2. Mengerjakan Kuis</h2>
            <ul class="list-disc list-inside description space-y-2">
                <li><strong>Jenis Kuis:</strong> Aplikasi ini mendukung dua jenis kuis: Pilihan Ganda (Multiple Choice) dan Esai.</li>
                <li><strong>Memulai Kuis:</strong> Setelah mempelajari modul, Anda mungkin akan menemukan tautan untuk memulai kuis terkait. Klik tautan tersebut untuk memulai.</li>
                <li><strong>Pilihan Ganda:</strong> Pilih jawaban yang paling tepat dari opsi yang tersedia. Hasil akan langsung terlihat setelah selesai.</li>
                <li><strong>Esai:</strong> Tulis jawaban Anda pada kolom yang disediakan. Jawaban esai akan dinilai secara manual oleh pengajar.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-6 mb-3">3. Melacak Hasil Belajar</h2>
            <ul class="list-disc list-inside description space-y-2">
                <li><strong>Halaman Skor Saya:</strong> Anda dapat melihat semua hasil kuis yang telah Anda kerjakan di halaman <a href="{{ route('scores.index') }}" class="text-teal-600 hover:underline">Skor Saya</a>.</li>
                <li><strong>Detail Hasil:</strong> Klik pada entri skor untuk melihat detail hasil kuis Anda, termasuk jawaban yang benar/salah untuk pilihan ganda dan umpan balik untuk esai.</li>
            </ul>

            <p class="description mt-6">
                Jika Anda memiliki pertanyaan lebih lanjut atau mengalami kesulitan, jangan ragu untuk menghubungi kami melalui halaman <a href="{{ route('about') }}" class="text-teal-600 hover:underline">Tentang Kami</a>. Selamat belajar!
            </p>

            <div class="cta-buttons mt-8">
                <a href="{{ route('listModule') }}" class="primary-btn">Mulai Belajar Sekarang</a>
                <a href="{{ route('about') }}" class="secondary-btn">
                    <span class="play-icon">ℹ️</span>
                    Tentang Kami
                </a>
            </div>
        </div>
        <div class="content-right">
            <div class="hero-placeholder">
                <img src="{{ asset('images/how-to-use-hero.png') }}" alt="Ilustrasi Panduan Penggunaan" class="w-full h-auto rounded-lg shadow-lg">
                {{-- Placeholder for a specific image. You might need to create 'public/images/how-to-use-hero.png' --}}
            </div>
        </div>
    </main>
@endsection