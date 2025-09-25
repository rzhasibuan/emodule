@extends('layouts.fe-new')

@section('title', 'Green module - this platform to help you learn and practice in english')

@section("content")

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-left">
            <h1>
                {!! $settings['home_title']->value ?? '' !!}
            </h1>
            <p class="description">
                {!! $settings['home_description']->value ?? '' !!}
            </p>
            <div class="cta-buttons">
                <a href="{{route("listModule")}}" class="primary-btn" style="text-decoration: none">Lihat Modul Terbaru</a>
                <button class="secondary-btn">
                    <span class="play-icon">▶</span>
                    Lihat Video Tutorial
                </button>
            </div>
        </div>
        <div class="content-right">
            <div class="hero-placeholder">
                <img src="{{ asset('banner.png') }}" style="width: 100%; border-radius: 10px" alt="Hero Placeholder" />
            </div>
        </div>
    </main>


    <br>
    <br>
    <br>
    <br>




@endsection
