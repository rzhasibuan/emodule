@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Grade Quiz for {{ $result->user->name }} - {{ $result->module->name }}</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('grading.store', $result) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($answers as $index => $answer)
                                @if ($answer['type'] === 'essay')
                                    <div class="p-4 border rounded-lg mb-4">
                                        <p class="font-semibold">{{ $answer['question'] }}</p>
                                        <p class="mt-2"><strong>User's Answer:</strong></p>
                                        <p class="whitespace-pre-wrap">{{ $answer['user_answer'] ?: 'Not answered' }}</p>
                                        <p class="mt-2"><strong>Answer Key:</strong></p>
                                        <p class="whitespace-pre-wrap">{{ $answer['correct_answer'] }}</p>
                                        <div class="form-group mt-4">
                                            <label for="scores[{{ $index }}]">Score</label>
                                            <input type="number" name="scores[{{ $index }}]" class="form-control" min="0" max="1" step="1" required>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit Grade</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
