@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Module Details</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-primary">Back to List</a>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $module->name }}</h5>
            <p><strong>File:</strong> {{ $module->file }}</p>
            <p><strong>Quiz Link:</strong> {{ $module->link_quiz }}</p>
            <p><strong>Video Link:</strong> {{ $module->link_video }}</p>
            <p><strong>Created At:</strong> {{ $module->created_at->format('d M Y') }}</p>
            <p><strong>Updated At:</strong> {{ $module->updated_at->format('d M Y') }}</p>
            @if(Auth::user()->id_level == 1)
                <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this module?')">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endsection

