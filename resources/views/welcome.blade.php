@extends('layouts.fe')

@section('title', 'Green module - this platform to help you learn and practice in english')

@section("content")
    <div class="max-w-7xl mx-auto p-4 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Sidebar dengan pencarian (tetap ada) -->
            <aside class="lg:col-span-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 space-y-3" id="sidebar">
                    <div>
                        <label for="search" class="text-sm text-gray-600 dark:text-gray-300">Cari modul</label>
                        <input id="search" class="mt-1 w-full border rounded-lg px-3 py-2
                   border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900"
                               placeholder="Ketik judul modul..." />
                    </div>

                    <div id="moduleList" class="space-y-2">
                        <button class="w-full text-left px-3 py-2 rounded-lg border transition bg-teal-600 text-white"
                                data-source="example-assets/books/intro.pdf">📘 Modul 1: Pengenalan</button>
                        <button class="w-full text-left px-3 py-2 rounded-lg border transition bg-white text-gray-800 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800"
                                data-source="example-assets/books/proposal.pdf">📗 Modul 2: Panduan Praktik</button>
                        <button class="w-full text-left px-3 py-2 rounded-lg border transition bg-white text-gray-800 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800"
                                data-source="example-assets/books/quickref.pdf">📕 Modul 3: Referensi Cepat</button>
                        <button class="w-full text-left px-3 py-2 rounded-lg border transition bg-white text-gray-800 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800"
                                data-source="example-assets/books/case-study.pdf">📙 Modul 4: Studi Kasus</button>
                    </div>
                    <p id="noResults" class="hidden text-sm text-gray-500">Tidak ada modul yang cocok.</p>
                </div>
            </aside>

            <!-- Viewer tunggal -->
            <section class="lg:col-span-9">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                    <div id="viewerArea"><!-- Flipbook akan disuntik di sini --></div>
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Quiz Links</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <a href="https://quiz1.example.com" target="_blank" class="flex flex-col items-center p-4 bg-blue-100 dark:bg-blue-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer">
                                <div class="bg-blue-500 dark:bg-blue-700 text-white rounded-full p-3 mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><!-- quiz icon --></svg>
                                </div>
                                <span class="font-semibold">Quiz 1</span>
                                <span class="text-xs text-blue-700 dark:text-blue-200 mt-1">Take Quiz</span>
                            </a>
                            <a href="https://quiz2.example.com" target="_blank" class="flex flex-col items-center p-4 bg-blue-100 dark:bg-blue-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer">
                                <div class="bg-blue-500 dark:bg-blue-700 text-white rounded-full p-3 mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><!-- quiz icon --></svg>
                                </div>
                                <span class="font-semibold">Quiz 2</span>
                                <span class="text-xs text-blue-700 dark:text-blue-200 mt-1">Take Quiz</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Video Links</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <a href="https://youtube.com/watch?v=abc123" target="_blank" class="flex flex-col items-center p-4 bg-red-100 dark:bg-red-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer">
                                <div class="bg-red-500 dark:bg-red-700 text-white rounded-full p-3 mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><!-- YouTube icon --></svg>
                                </div>
                                <span class="font-semibold">Video 1</span>
                                <span class="text-xs text-red-700 dark:text-red-200 mt-1">Watch Video</span>
                            </a>
                            <a href="https://youtube.com/watch?v=def456" target="_blank" class="flex flex-col items-center p-4 bg-red-100 dark:bg-red-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer">
                                <div class="bg-red-500 dark:bg-red-700 text-white rounded-full p-3 mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><!-- YouTube icon --></svg>
                                </div>
                                <span class="font-semibold">Video 2</span>
                                <span class="text-xs text-red-700 dark:text-red-200 mt-1">Watch Video</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
