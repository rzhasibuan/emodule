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
                        @forelse($module as $m)
                            <button
                                class="w-full text-left px-3 py-2 rounded-lg border transition bg-white text-gray-800 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800 module-btn"
                                data-name="{{ $m->name }}"
                                data-source="{{ $m->file ? asset('storage/' . $m->file) : '' }}"
                                data-module-id="{{ $m->id }}"
                                data-has-quiz="{{ $m->quizzes->isNotEmpty() }}"
                                data-quiz-taken="{{ $m->quiz_taken ?? false }}"
                                data-score="{{ $m->score ?? 0 }}"
                                data-videos='{{ json_encode($m->link_video ?: []) }}'
                            >
                                📘 {{ $m->name }}
                            </button>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada modul.</p>
                        @endforelse
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
                        <div id="quizContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"></div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Video Links</h2>
                        <div id="videoContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Inline script (no @push needed) --}}
    <script>
        (function() {
            const quizContainer  = document.getElementById('quizContainer');
            const videoContainer = document.getElementById('videoContainer');

            const searchInput = document.getElementById('search');
            const moduleList  = document.getElementById('moduleList');
            const noResults   = document.getElementById('noResults');

            // --- Search filter ---
            function filterModules() {
                const q = (searchInput.value || '').toLowerCase();
                let visible = 0;
                moduleList.querySelectorAll('.module-btn').forEach(btn => {
                    const name = (btn.dataset.name || '').toLowerCase();
                    const show = name.includes(q);
                    btn.classList.toggle('hidden', !show);
                    if (show) visible++;
                });
                noResults.classList.toggle('hidden', visible > 0);
            }
            if (searchInput) searchInput.addEventListener('input', filterModules);

            // Accept both string URLs and {title,url} objects
            function normalize(list, defaultPrefix) {
                if (!Array.isArray(list)) return [];
                return list.map((item, idx) => {
                    if (typeof item === 'string') {
                        return { title: `${defaultPrefix} ${idx + 1}`, url: item };
                    }
                    if (item && typeof item === 'object') {
                        return { title: item.title || `${defaultPrefix} ${idx + 1}`, url: item.url || '' };
                    }
                    return null;
                }).filter(Boolean).filter(x => x.url);
            }

            function renderCards(container, data, type, moduleId = null) {
                container.innerHTML = '';
                if (type === 'quiz') {
                    if (data.hasQuiz) {
                        if (data.quizTaken) {
                            const card = document.createElement('div');
                            card.className = 'flex flex-col items-center p-4 bg-green-100 dark:bg-green-900 rounded-xl shadow';
                            const icon = `<div class="bg-green-500 dark:bg-green-700 text-white rounded-full p-3 mb-2">
                                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                           </svg>
                                       </div>`;
                            card.innerHTML = `
                                ${icon}
                                <span class="font-semibold">Quiz Taken</span>
                                <span class="text-xs text-green-700 dark:text-green-200 mt-1">Your Score: ${data.score}</span>
                            `;
                            container.appendChild(card);
                        } else {
                            const card = document.createElement('a');
                            card.setAttribute('href', `/module/${moduleId}/quiz`);
                            card.className = 'flex flex-col items-center p-4 bg-blue-100 dark:bg-blue-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer';
                            const icon = `<div class="bg-blue-500 dark:bg-blue-700 text-white rounded-full p-3 mb-2">
                                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
                                           </svg>
                                       </div>`;
                            card.innerHTML = `
                                ${icon}
                                <span class="font-semibold">Take the Quiz</span>
                                <span class="text-xs text-blue-700 dark:text-blue-200 mt-1">Test your knowledge</span>
                            `;
                            container.appendChild(card);
                        }
                    } else {
                        const msg = document.createElement('p');
                        msg.className = 'text-gray-500 dark:text-gray-400 col-span-full text-center';
                        msg.textContent = `No quiz available for this module.`;
                        container.appendChild(msg);
                    }
                    return;
                }

                if (!items.length) {
                    const msg = document.createElement('p');
                    msg.className = 'text-gray-500 dark:text-gray-400 col-span-full text-center';
                    msg.textContent = `No ${type} available for this module.`;
                    container.appendChild(msg);
                    return;
                }

                items.forEach((it) => {
                    const card = document.createElement('a');
                    card.setAttribute('href', it.url);
                    card.setAttribute('target', '_blank');
                    card.setAttribute('rel', 'noopener noreferrer');
                    card.className = 'flex flex-col items-center p-4 bg-red-100 dark:bg-red-900 rounded-xl shadow hover:scale-105 transition-transform cursor-pointer';

                    const icon = `<div class="bg-red-500 dark:bg-red-700 text-white rounded-full p-3 mb-2">
                                   <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                   </svg>
                               </div>`;

                    card.innerHTML = `
                    ${icon}
                    <span class="font-semibold">${it.title}</span>
                    <span class="text-xs text-red-700 dark:text-red-200 mt-1">Watch Video</span>
                `;
                    container.appendChild(card);
                });
            }

            function parseMaybeJSON(raw, fallback) {
                try {
                    let v = JSON.parse(raw);
                    // If first parse yields a string (double-encoded), parse again
                    if (typeof v === 'string') {
                        try { v = JSON.parse(v); } catch {}
                    }
                    return Array.isArray(v) ? v : fallback;
                } catch {
                    return fallback;
                }
            }

            function updateContent(btn) {
                const hasQuiz = btn.dataset.hasQuiz === '1';
                const moduleId = btn.dataset.moduleId;
                const quizTaken = btn.dataset.quizTaken === '1';
                const score = btn.dataset.score;
                const videosRaw  = btn.getAttribute('data-videos')  || '[]';

                const videos  = parseMaybeJSON(videosRaw,  []);

                const vItems = normalize(videos,  'Video');

                renderCards(quizContainer,  { hasQuiz, quizTaken, score }, 'quiz', moduleId);
                renderCards(videoContainer, vItems, 'video');

                // Notify your flipbook/pdf script
                const src  = btn.dataset.source || '';
                const name = btn.dataset.name   || '';
                const ev = new CustomEvent('module:change', { detail: { src, name } });
                document.getElementById('viewerArea').dispatchEvent(ev);
            }

            // Click handlers
            document.querySelectorAll('.module-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.module-btn').forEach(b => {
                        b.classList.remove('bg-teal-600', 'text-white');
                        b.classList.add('bg-white','text-gray-800','hover:bg-gray-100','dark:bg-gray-900','dark:text-gray-100','dark:hover:bg-gray-800');
                    });
                    btn.classList.remove('bg-white','text-gray-800','hover:bg-gray-100','dark:bg-gray-900','dark:text-gray-100','dark:hover:bg-gray-800');
                    btn.classList.add('bg-teal-600','text-white');

                    updateContent(btn);
                });
            });

            // Init first module (if any)
            const firstModule = document.querySelector('.module-btn');
            if (firstModule) {
                firstModule.classList.add('bg-teal-600', 'text-white');
                updateContent(firstModule);
            }
        })();
    </script>
@endsection