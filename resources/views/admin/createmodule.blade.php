@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Add Module</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
    <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="file">File (PDF only)</label>
            <input type="file" name="file" class="form-control" id="file" accept="application/pdf">
        </div>
        <div class="form-group">
            <label>Quiz Links</label>
            <div id="quiz-links">
                <input type="text" name="link_quiz[]" class="form-control mb-2" value="">
            </div>
            <button type="button" class="btn btn-sm btn-info" onclick="addQuizLink()">Add Quiz Link</button>
        </div>
        <div class="form-group">
            <label>Video Links</label>
            <div id="video-links">
                <input type="text" name="link_video[]" class="form-control mb-2" value="">
            </div>
            <button type="button" class="btn btn-sm btn-info" onclick="addVideoLink()">Add Video Link</button>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
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
