@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Edit Module</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
    <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $module->name) }}">
        </div>
        <div class="form-group">
            <label for="file_name">File Name (without .pdf)</label>
            <input type="text" name="file_name" class="form-control" id="file_name" value="{{ old('file_name', pathinfo($module->file, PATHINFO_FILENAME)) }}">
        </div>
        <div class="form-group">
            <label for="file">File (PDF only)</label>
            @if($module->file)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $module->file) }}" target="_blank">Current File</a>
                </div>
            @endif
            <input type="file" name="file" class="form-control" id="file" accept="application/pdf">
            <small class="form-text text-muted">Leave blank to keep current file.</small>
        </div>
        <div class="form-group">
            <label>Quiz Links</label>
            <div id="quiz-links">
                @php $quizLinks = json_decode($module->link_quiz ?? '[]', true); @endphp
                @foreach($quizLinks as $link)
                    <input type="text" name="link_quiz[]" class="form-control mb-2" value="{{ $link }}">
                @endforeach
                <input type="text" name="link_quiz[]" class="form-control mb-2" value="">
            </div>
            <button type="button" class="btn btn-sm btn-info" onclick="addQuizLink()">Add Quiz Link</button>
        </div>
        <div class="form-group">
            <label>Video Links</label>
            <div id="video-links">
                @php $videoLinks = json_decode($module->link_video ?? '[]', true); @endphp
                @foreach($videoLinks as $link)
                    <input type="text" name="link_video[]" class="form-control mb-2" value="{{ $link }}">
                @endforeach
                <input type="text" name="link_video[]" class="form-control mb-2" value="">
            </div>
            <button type="button" class="btn btn-sm btn-info" onclick="addVideoLink()">Add Video Link</button>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
    function addQuizLink() {
        const container = document.getElementById('quiz-links');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'link_quiz[]';
        input.className = 'form-control mb-2';
        container.appendChild(input);
    }
    function addVideoLink() {
        const container = document.getElementById('video-links');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'link_video[]';
        input.className = 'form-control mb-2';
        container.appendChild(input);
    }
    </script>
@endsection
