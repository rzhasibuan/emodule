@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Edit Module</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-primary">Back to List</a>
    </div>
    <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $module->name) }}">
        </div>
        <div class="form-group">
            <label for="file">File (PDF only)</label>
            @if($module->file)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf"></i> Current File</a>
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
                    <div class="input-group mb-2">
                        <input type="text" name="link_quiz[]" class="form-control" value="{{ $link }}" placeholder="Enter quiz link">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                @endforeach
                <div class="input-group mb-2">
                    <input type="text" name="link_quiz[]" class="form-control" value="" placeholder="Enter quiz link">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" onclick="addQuizLink()"><i class="fas fa-plus"></i> Add Quiz Link</button>
        </div>
        <div class="form-group">
            <label>Video Links</label>
            <div id="video-links">
                @php $videoLinks = json_decode($module->link_video ?? '[]', true); @endphp
                @foreach($videoLinks as $link)
                    <div class="input-group mb-2">
                        <input type="text" name="link_video[]" class="form-control" value="{{ $link }}" placeholder="Enter video link">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                @endforeach
                <div class="input-group mb-2">
                    <input type="text" name="link_video[]" class="form-control" value="" placeholder="Enter video link">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" onclick="addVideoLink()"><i class="fas fa-plus"></i> Add Video Link</button>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
    function addQuizLink() {
        const container = document.getElementById('quiz-links');
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group mb-2';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'link_quiz[]';
        input.className = 'form-control';
        input.placeholder = 'Enter quiz link';
        const append = document.createElement('div');
        append.className = 'input-group-append';
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-danger btn-sm';
        btn.innerHTML = '<i class="fas fa-trash"></i> Remove';
        btn.onclick = function() { wrapper.remove(); };
        append.appendChild(btn);
        wrapper.appendChild(input);
        wrapper.appendChild(append);
        container.appendChild(wrapper);
    }
    function addVideoLink() {
        const container = document.getElementById('video-links');
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group mb-2';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'link_video[]';
        input.className = 'form-control';
        input.placeholder = 'Enter video link';
        const append = document.createElement('div');
        append.className = 'input-group-append';
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-danger btn-sm';
        btn.innerHTML = '<i class="fas fa-trash"></i> Remove';
        btn.onclick = function() { wrapper.remove(); };
        append.appendChild(btn);
        wrapper.appendChild(input);
        wrapper.appendChild(append);
        container.appendChild(wrapper);
    }
    </script>
@endsection
