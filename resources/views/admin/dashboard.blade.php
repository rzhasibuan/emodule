@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2>{{ $users->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Modules</h5>
                    <h2>{{ $modules->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Latest Users</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->sortByDesc('created_at')->take(5) as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->id_level == 1 ? 'Admin' : 'User' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Latest Modules</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules->sortByDesc('created_at')->take(5) as $module)
                            <tr>
                                <td>{{ $module->name }}</td>
                                <td>
                                    @if($module->file)
                                        <a href="{{ asset('storage/' . $module->file) }}" target="_blank">PDF</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
