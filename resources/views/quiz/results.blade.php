@extends('layouts.fe')

@section('title', 'Hasil Quiz')

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center">Hasil Quiz untuk {{ $quizResult->module->name }}</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <div class="text-center mb-4">
                        <h2 class="text-xl font-semibold">Nilai Pilihan Ganda</h2>
                        <p class="text-3xl font-bold text-teal-600">{{ $quizResult->score }}</p>
                    </div>
                    <div class="space-y-4">
                        @foreach (json_decode($quizResult->answers, true) as $result)
                            <div class="p-4 border rounded-lg {{ isset($result['correct']) && $result['correct'] ? 'bg-green-50 dark:bg-green-900 border-green-200 dark:border-green-700' : 'bg-red-50 dark:bg-red-900 border-red-200 dark:border-red-700' }}">
                                <p class="font-semibold">{{ $result['question'] }}</p>
                                <p>Jawaban Anda: <span class="font-bold">{{ $result['user_answer'] ? strtoupper($result['user_answer']) : 'Belum dijawab' }}</span></p>
                                @if (isset($result['correct']) && !$result['correct'])
                                    <p>Kunci Jawaban: <span class="font-bold">{{ strtoupper($result['correct_answer']) }}</span></p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    @php
                        $essayAnswers = \App\Models\EssayAnswer::where('quiz_result_id', $quizResult->id)->get();
                    @endphp
                    <div class="text-center mb-4">
                        <h2 class="text-xl font-semibold">Nilai Essay</h2>
                        <p class="text-3xl font-bold text-yellow-600">
                            @if($quizResult->score_essay !== null)
                                {{ $quizResult->score_essay }}
                            @else
                                <span class="text-base">Tidak tersedia</span>
                            @endif
                        </p>
                    </div>
                    <div class="space-y-4">
                        @foreach ($essayAnswers as $ans)
                            <div class="p-4 border rounded-lg bg-yellow-50 dark:bg-yellow-900 border-yellow-200 dark:border-yellow-700">
                                <p class="font-semibold">{{ $ans->question }}</p>
                                <p class="mt-2"><strong>Jawaban Anda:</strong></p>
                                <p class="whitespace-pre-wrap">{{ $ans->user_answer ?: 'Belum dijawab' }}</p>
                                @if($ans->score !== null)
                                    <p class="mt-2"><strong>Nilai:</strong> {{ $ans->score }}</p>
                                @else
                                    <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">Soal ini akan dinilai secara manual oleh guru.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-center">
            <a href="{{ route('welcome') }}" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition-colors">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
