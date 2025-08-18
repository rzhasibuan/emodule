@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Modules</h1>
        <a href="{{ route('modules.create') }}" class="btn btn-success">Add Module</a>
    </div>
    <table class="table table-hover table-striped table-border">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>File</th>
                <th>Quiz Link</th>
                <th>Video Link</th>
                <th>Last Update</th>
                @if(Auth::user()->id_level == 1)
                    <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $module->name }}</td>
                <td>{{ $module->file }}</td>
                <td>{{ $module->link_quiz }}</td>
                <td>{{ $module->link_video }}</td>
                <td>{{ $module->updated_at->format('d M Y') }}</td>
                @if(Auth::user()->id_level == 1)
                <td>
                    <a href="{{ route('modules.show', $module->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this module?')"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

