@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Edit Quiz</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('quizzes.update', $quiz) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea name="question" id="question" class="form-control" required>{{ old('question', $quiz->question) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="module_id">Module</label>
                                <select name="module_id" id="module_id" class="form-control" required>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}" {{ $quiz->module_id == $module->id ? 'selected' : '' }}>{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="option_a">Option A</label>
                                <input type="text" name="option_a" id="option_a" class="form-control" value="{{ old('option_a', $quiz->option_a) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="option_b">Option B</label>
                                <input type="text" name="option_b" id="option_b" class="form-control" value="{{ old('option_b', $quiz->option_b) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="option_c">Option C</label>
                                <input type="text" name="option_c" id="option_c" class="form-control" value="{{ old('option_c', $quiz->option_c) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="option_d">Option D</label>
                                <input type="text" name="option_d" id="option_d" class="form-control" value="{{ old('option_d', $quiz->option_d) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Correct Answer</label>
                                <select name="correct_answer" id="correct_answer" class="form-control" required>
                                    <option value="a" {{ $quiz->correct_answer == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="b" {{ $quiz->correct_answer == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="c" {{ $quiz->correct_answer == 'c' ? 'selected' : '' }}>C</option>
                                    <option value="d" {{ $quiz->correct_answer == 'd' ? 'selected' : '' }}>D</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
