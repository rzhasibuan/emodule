@extends('layouts.fe')

@section('title', 'Quiz: ' . $quiz->question)

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <!-- Header Pertanyaan -->
        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center">{{ $quiz->question }}</h1>
        </div>

        <!-- Form Kuis -->
        <form id="quizForm" action="{{ route('quiz.submit', $quiz) }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <!-- Opsi Jawaban -->
                @php
                    $options = [
                        'a' => $quiz->option_a,
                        'b' => $quiz->option_b,
                        'c' => $quiz->option_c,
                        'd' => $quiz->option_d,
                    ];
                @endphp

                <div id="optionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($options as $key => $value)
                        <div class="option-card rounded-lg border border-gray-300 dark:border-gray-600 p-4 cursor-pointer transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                             data-option="{{ $key }}">
                            <span class="font-mono font-bold text-teal-500 mr-3">{{ strtoupper($key) }}</span>
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="answer" id="selectedAnswer">

                <!-- Feedback -->
                <div id="feedback" class="hidden mt-4 p-4 rounded-lg text-center font-semibold"></div>

            </div>

            <!-- Tombol Submit -->
            <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-center">
                <button type="submit" id="submitBtn" class="w-full md:w-auto bg-teal-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-teal-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Submit Answer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const optionsContainer = document.getElementById('optionsContainer');
        const selectedAnswerInput = document.getElementById('selectedAnswer');
        const quizForm = document.getElementById('quizForm');
        const submitBtn = document.getElementById('submitBtn');
        const feedback = document.getElementById('feedback');

        let selectedOption = null;

        optionsContainer.addEventListener('click', (e) => {
            const card = e.target.closest('.option-card');
            if (!card || submitBtn.disabled) return;

            // Hapus seleksi sebelumnya
            if (selectedOption) {
                selectedOption.classList.remove('bg-teal-100', 'dark:bg-teal-900', 'ring-2', 'ring-teal-500');
            }

            // Seleksi baru
            card.classList.add('bg-teal-100', 'dark:bg-teal-900', 'ring-2', 'ring-teal-500');
            selectedOption = card;
            selectedAnswerInput.value = card.dataset.option;
        });

        quizForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!selectedAnswerInput.value) {
                alert('Please select an answer!');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Checking...';

            fetch(quizForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ answer: selectedAnswerInput.value })
            })
            .then(response => response.json())
            .then(data => {
                // Tampilkan feedback
                feedback.classList.remove('hidden');
                if (data.correct) {
                    feedback.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200');
                    feedback.textContent = 'Correct! Well done.';
                    selectedOption.classList.add('bg-green-200', 'dark:bg-green-800');
                } else {
                    feedback.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-200');
                    feedback.textContent = 'Incorrect. The correct answer was ' + data.correct_answer.toUpperCase() + '.';
                    selectedOption.classList.add('bg-red-200', 'dark:bg-red-800');
                    // Tampilkan jawaban yang benar
                    const correctCard = optionsContainer.querySelector(`[data-option="${data.correct_answer}"]`);
                    if(correctCard) {
                        correctCard.classList.add('bg-green-200', 'dark:bg-green-800', 'ring-2', 'ring-green-500');
                    }
                }

                // Nonaktifkan semua pilihan
                optionsContainer.querySelectorAll('.option-card').forEach(card => {
                    card.style.cursor = 'not-allowed';
                });
                submitBtn.textContent = 'Answer Submitted';
            })
            .catch(error => {
                console.error('Error:', error);
                feedback.classList.remove('hidden');
                feedback.classList.add('bg-red-100', 'text-red-800');
                feedback.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Answer';
            });
        });
    });
</script>
@endpush