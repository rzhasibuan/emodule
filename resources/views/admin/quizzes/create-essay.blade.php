@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Create Essay Quiz</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('quizzes.storeEssay') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea name="question" id="question" class="form-control" required>{{ old('question') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="module_id">Module</label>
                                <select name="module_id" id="module_id" class="form-control" required>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="answer_key">Answer Key</label>
                                <textarea name="answer_key" id="answer_key" class="form-control" required>{{ old('answer_key') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
