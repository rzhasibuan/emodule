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
                </div>
            </section>
        </div>
    </div>
@endsection
