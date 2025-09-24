@extends('layouts.fe')

@section('title', 'Quiz for ' . $module->name)

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center">Quiz: {{ $module->name }}</h1>
        </div>
        <div id="tab-section" class="flex justify-center mt-4 gap-4"></div>
        <div id="quiz-container" class="p-6"></div>
        <div id="nav-section" class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quizzes = @json($quizzes);
        const mcQuizzes = quizzes.filter(q => q.type === 'multiple_choice');
        const essayQuizzes = quizzes.filter(q => q.type === 'essay');
        let currentType = mcQuizzes.length > 0 ? 'multiple_choice' : 'essay';
        let currentQuestionIndex = 0;
        const userAnswers = { multiple_choice: new Array(mcQuizzes.length).fill(null), essay: new Array(essayQuizzes.length).fill(null) };

        const quizContainer = document.getElementById('quiz-container');
        const navSection = document.getElementById('nav-section');
        const tabSection = document.getElementById('tab-section');

        // Render tab only if both types exist
        if (mcQuizzes.length > 0 && essayQuizzes.length > 0) {
            tabSection.innerHTML = `
                <button id="tab-mc" class="tab-btn bg-teal-600 text-white px-4 py-2 rounded">Multiple Choice</button>
                <button id="tab-essay" class="tab-btn bg-yellow-500 text-white px-4 py-2 rounded" disabled>Essay</button>
            `;
        }

        function renderQuestion() {
            let quiz, answer, contentHtml = '', questionCounter = '';
            if (currentType === 'multiple_choice') {
                quiz = mcQuizzes[currentQuestionIndex];
                answer = userAnswers.multiple_choice[currentQuestionIndex];
                if (!quiz) { quizContainer.innerHTML = '<p>Tidak ada soal pilihan ganda.</p>'; navSection.innerHTML = ''; return; }
                const options = { a: quiz.option_a, b: quiz.option_b, c: quiz.option_c, d: quiz.option_d };
                let optionsHtml = '';
                for (const [key, value] of Object.entries(options)) {
                    const isSelected = answer === key;
                    optionsHtml += `<div class="option-card p-4 border rounded-lg cursor-pointer ${isSelected ? 'bg-teal-100 dark:bg-teal-900 ring-2 ring-teal-500' : 'bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700'}" data-option="${key}"><span class="font-mono font-bold text-teal-500 mr-3">${key.toUpperCase()}</span><span>${value}</span></div>`;
                }
                contentHtml = `<h2 class="text-xl font-semibold mb-4">${quiz.question}</h2><div class="space-y-4">${optionsHtml}</div>`;
                questionCounter = `Soal ${currentQuestionIndex + 1} dari ${mcQuizzes.length}`;
            } else {
                quiz = essayQuizzes[currentQuestionIndex];
                answer = userAnswers.essay[currentQuestionIndex] || '';
                if (!quiz) { quizContainer.innerHTML = '<p>Tidak ada soal essay.</p>'; navSection.innerHTML = ''; return; }
                contentHtml = `<h2 class="text-xl font-semibold mb-4">${quiz.question}</h2><div><textarea class="w-full h-48 p-4 border rounded-lg dark:bg-gray-800 dark:text-white" placeholder="Ketik jawaban Anda di sini...">${answer}</textarea></div>`;
                questionCounter = `Soal ${currentQuestionIndex + 1} dari ${essayQuizzes.length}`;
            }
            quizContainer.innerHTML = contentHtml;
            let navHtml = `<button id="prevBtn" class="bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Sebelumnya</button><div id="question-counter" class="text-sm font-semibold text-gray-600 dark:text-gray-300">${questionCounter}</div><button id="nextBtn" class="bg-teal-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-teal-700 transition-colors">Selanjutnya</button><button id="finishBtn" class="hidden bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">Selesai ${currentType === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay'}</button>`;
            navSection.innerHTML = navHtml;
            updateButtons();
            attachNavEvents();
        }
        function updateButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const finishBtn = document.getElementById('finishBtn');
            const total = currentType === 'multiple_choice' ? mcQuizzes.length : essayQuizzes.length;
            prevBtn.disabled = currentQuestionIndex === 0;
            nextBtn.classList.toggle('hidden', currentQuestionIndex === total - 1);
            finishBtn.classList.toggle('hidden', currentQuestionIndex !== total - 1);
        }
        function attachNavEvents() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const finishBtn = document.getElementById('finishBtn');
            prevBtn.onclick = () => { if (currentQuestionIndex > 0) { currentQuestionIndex--; renderQuestion(); } };
            nextBtn.onclick = () => { const total = currentType === 'multiple_choice' ? mcQuizzes.length : essayQuizzes.length; if (currentQuestionIndex < total - 1) { currentQuestionIndex++; renderQuestion(); } };
            finishBtn.onclick = () => {
                if (currentType === 'multiple_choice' && essayQuizzes.length > 0) {
                    // Cek semua MC sudah dijawab
                    if (userAnswers.multiple_choice.some(ans => ans === null)) {
                        alert('Semua soal pilihan ganda harus dijawab!');
                        return;
                    }
                    // Pindah ke essay
                    currentType = 'essay';
                    currentQuestionIndex = 0;
                    // Aktifkan tab essay jika ada
                    const tabEssay = document.getElementById('tab-essay');
                    if (tabEssay) tabEssay.disabled = false;
                    renderQuestion();
                } else {
                    submitQuiz();
                }
            };
            // Tab event
            const tabMc = document.getElementById('tab-mc');
            const tabEssay = document.getElementById('tab-essay');
            if (tabMc) tabMc.onclick = () => {
                if (currentType !== 'multiple_choice') {
                    currentType = 'multiple_choice';
                    currentQuestionIndex = 0;
                    renderQuestion();
                }
            };
            if (tabEssay) tabEssay.onclick = () => {
                if (!tabEssay.disabled && currentType !== 'essay') {
                    currentType = 'essay';
                    currentQuestionIndex = 0;
                    renderQuestion();
                }
            };
        }
        quizContainer.onclick = (e) => {
            const card = e.target.closest('.option-card');
            if (card && currentType === 'multiple_choice') {
                userAnswers.multiple_choice[currentQuestionIndex] = card.dataset.option;
                renderQuestion();
            }
        };
        quizContainer.oninput = (e) => {
            const textarea = e.target.closest('textarea');
            if (textarea && currentType === 'essay') {
                userAnswers.essay[currentQuestionIndex] = textarea.value;
            }
        };
        function submitQuiz() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("module.quiz.submit", $module) }}';
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            userAnswers.multiple_choice.forEach((answer, idx) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `answers[mc_${idx}]`;
                input.value = answer;
                form.appendChild(input);
            });
            userAnswers.essay.forEach((answer, idx) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `answers[essay_${idx}]`;
                input.value = answer;
                form.appendChild(input);
            });
            document.body.appendChild(form);
            form.submit();
        }
        // Initial render
        if (mcQuizzes.length > 0 && essayQuizzes.length > 0) {
            renderQuestion();
        } else if (mcQuizzes.length > 0) {
            tabSection.innerHTML = '';
            currentType = 'multiple_choice';
            renderQuestion();
        } else if (essayQuizzes.length > 0) {
            tabSection.innerHTML = '';
            currentType = 'essay';
            renderQuestion();
        } else {
            quizContainer.innerHTML = '<p class="text-center text-gray-500">Tidak ada soal untuk modul ini.</p>';
            navSection.innerHTML = '';
        }
    });
</script>
@endpush
