@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Quizzes</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Add New Quiz</a>
            <a href="{{ route('quizzes.createEssay') }}" class="btn btn-primary ml-2">Add New Essay Quiz</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark font-weight-bold">Essay Quizzes</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Module</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $essayQuizzes = $quizzes->where('type', 'essay'); @endphp
                                @forelse ($essayQuizzes as $quiz)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $quiz->question }}</td>
                                        <td>{{ $quiz->module->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4">No essay quizzes found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white font-weight-bold">Multiple Choice Quizzes</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Module</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $mcQuizzes = $quizzes->where('type', '!=', 'essay'); @endphp
                                @forelse ($mcQuizzes as $quiz)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $quiz->question }}</td>
                                        <td>{{ $quiz->module->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4">No multiple choice quizzes found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
