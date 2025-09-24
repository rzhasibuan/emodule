@extends('layouts.fe')

@section('title', 'Green module - this platform to help you learn and practice in english')

@section("content")
    <div class="min-h-screen flex items-center justify-center bg-green-8ga 00 dark:bg-gray-900">
        <div class="w-full max-w-5xl p-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <div id="viewerArea">
                    @if($modules->file)
                        <div class="_df_book" webgl="true" height="1020" source="{{ asset('storage/' . $modules->file) }}"></div>
                    @else
                        <p>Tidak ada file PDF yang tersedia untuk modul ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
