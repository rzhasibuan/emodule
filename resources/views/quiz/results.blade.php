@extends('layouts.fe')

@section('title', 'Quiz Results')

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center">Quiz Results for {{ $quizResult->module->name }}</h1>
        </div>

        <div class="p-6">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold">Your Score:</h2>
                <p class="text-4xl font-bold text-teal-600">{{ $quizResult->score }} / {{ count(json_decode($quizResult->answers, true)) }}</p>
            </div>

            <div class="space-y-4">
                @foreach (json_decode($quizResult->answers, true) as $result)
                    <div class="p-4 border rounded-lg {{ $result['correct'] ? 'bg-green-50 dark:bg-green-900 border-green-200 dark:border-green-700' : 'bg-red-50 dark:bg-red-900 border-red-200 dark:border-red-700' }}">
                        <p class="font-semibold">{{ $result['question'] }}</p>
                        <p>Your answer: <span class="font-bold">{{ $result['user_answer'] ? strtoupper($result['user_answer']) : 'Not answered' }}</span></p>
                        @if (!$result['correct'])
                            <p>Correct answer: <span class="font-bold">{{ strtoupper($result['correct_answer']) }}</span></p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-center">
            <a href="{{ route('welcome') }}" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition-colors">Back to Home</a>
        </div>
    </div>
</div>
@endsection
