@extends('layouts.fe-new')

@section('title', 'Tentang Kami - E-Modul Platform')

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="content-left">
            <h1>
                {!! $settings['about_title']->value ?? '' !!}
            </h1>
            <p class="description">
                {!! $settings['about_description']->value ?? '' !!}
            </p>

            <h2 class="text-2xl font-bold mt-6 mb-3" style="color: #fff3cd">{!! $settings['about_vision_title']->value ?? '' !!}</h2>
            <p class="description">
                {!! $settings['about_vision_description']->value ?? '' !!}
            </p>

            <h2 class="text-2xl font-bold mt-6 mb-3" style="color: #fff3cd">{!! $settings['about_mission_title']->value ?? '' !!}</h2>
            <ul class="list-disc list-inside description space-y-2">
                {!! $settings['about_mission_list']->value ?? '' !!}
            </ul>

            <p class="description mt-6">
                {!! $settings['about_closing_text']->value ?? '' !!}
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
