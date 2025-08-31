@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Quizzes</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Add New Quiz</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
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
                                @foreach ($quizzes as $quiz)
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
