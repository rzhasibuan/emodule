@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Grade Essay Quizzes</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Module</th>
                                    <th>Score</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $result->user->name }}</td>
                                        <td>{{ $result->module->name }}</td>
                                        <td>{{ $result->score }} / {{ count(json_decode($result->answers, true)) }}</td>
                                        <td>
                                            <a href="{{ route('grading.show', $result) }}" class="btn btn-sm btn-info">Grade</a>
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
