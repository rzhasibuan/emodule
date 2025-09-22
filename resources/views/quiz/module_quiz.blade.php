@extends('layouts.fe')

@section('title', 'Quiz for ' . $module->name)

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center">Quiz: {{ $module->name }}</h1>
        </div>

        <div id="quiz-container" class="p-6">
            <!-- Quiz content will be injected here by JavaScript -->
        </div>

        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
            <button id="prevBtn" class="bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Previous</button>
            <div id="question-counter" class="text-sm font-semibold text-gray-600 dark:text-gray-300"></div>
            <button id="nextBtn" class="bg-teal-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-teal-700 transition-colors">Next</button>
            <button id="finishBtn" class="hidden bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">Finish Quiz</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quizzes = @json($quizzes);
        const quizContainer = document.getElementById('quiz-container');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const finishBtn = document.getElementById('finishBtn');
        const questionCounter = document.getElementById('question-counter');

        let currentQuestionIndex = 0;
        const userAnswers = new Array(quizzes.length).fill(null);

        function renderQuestion(index) {
            const quiz = quizzes[index];
            let contentHtml = '';

            if (quiz.type === 'multiple_choice') {
                const options = {
                    a: quiz.option_a,
                    b: quiz.option_b,
                    c: quiz.option_c,
                    d: quiz.option_d,
                };

                let optionsHtml = '';
                for (const [key, value] of Object.entries(options)) {
                    const isSelected = userAnswers[index] === key;
                    optionsHtml += `
                        <div class="option-card p-4 border rounded-lg cursor-pointer ${isSelected ? 'bg-teal-100 dark:bg-teal-900 ring-2 ring-teal-500' : 'bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700'}" data-option="${key}">
                            <span class="font-mono font-bold text-teal-500 mr-3">${key.toUpperCase()}</span>
                            <span>${value}</span>
                        </div>
                    `;
                }
                contentHtml = `<div class="space-y-4">${optionsHtml}</div>`;
            } else if (quiz.type === 'essay') {
                const answer = userAnswers[index] || '';
                contentHtml = `
                    <div>
                        <textarea class="w-full h-48 p-4 border rounded-lg dark:bg-gray-800 dark:text-white" placeholder="Type your answer here...">${answer}</textarea>
                    </div>
                `;
            }

            quizContainer.innerHTML = `
                <h2 class="text-xl font-semibold mb-4">${quiz.question}</h2>
                ${contentHtml}
            `;

            questionCounter.textContent = `Question ${index + 1} of ${quizzes.length}`;
            updateButtons();
        }

        function updateButtons() {
            prevBtn.disabled = currentQuestionIndex === 0;
            nextBtn.classList.toggle('hidden', currentQuestionIndex === quizzes.length - 1);
            finishBtn.classList.toggle('hidden', currentQuestionIndex !== quizzes.length - 1);
        }

        quizContainer.addEventListener('click', (e) => {
            const card = e.target.closest('.option-card');
            if (card) {
                userAnswers[currentQuestionIndex] = card.dataset.option;
                renderQuestion(currentQuestionIndex); // Re-render to show selection
            }
        });

        quizContainer.addEventListener('input', (e) => {
            const textarea = e.target.closest('textarea');
            if (textarea) {
                userAnswers[currentQuestionIndex] = textarea.value;
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentQuestionIndex < quizzes.length - 1) {
                currentQuestionIndex++;
                renderQuestion(currentQuestionIndex);
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                renderQuestion(currentQuestionIndex);
            }
        });

        finishBtn.addEventListener('click', () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("module.quiz.submit", $module) }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            userAnswers.forEach((answer, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `answers[${index}]`;
                input.value = answer;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        });

        // Initial render
        if (quizzes.length > 0) {
            renderQuestion(currentQuestionIndex);
        } else {
            quizContainer.innerHTML = '<p class="text-center text-gray-500">No quizzes available for this module.</p>';
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
            finishBtn.classList.add('hidden');
            questionCounter.classList.add('hidden');
        }
    });
</script>
@endpush
