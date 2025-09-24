@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Add Module</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-primary">Back to List</a>
    </div>
    <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Module name">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" value="{{ old('category') }}" placeholder="Module category (e.g., Matematika, IPA)">
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Module description">{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" value="{{ old('author') }}" placeholder="Module author">
            @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="file">File (PDF only)</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" accept="application/pdf">
            <small class="form-text text-muted">Max 2MB.</small>
            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="image">Module Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
            <small class="form-text text-muted">Max 2MB. (jpeg, png, jpg, gif, svg)</small>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Video Links</label>
            <div id="video-links">
                <div class="input-group mb-2">
                    <input type="text" name="link_video[]" class="form-control" value="{{ old('link_video.0') }}" placeholder="Enter video link (e.g. https://youtube.com/watch?v=...)">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" onclick="addVideoLink()">
                <i class="fas fa-plus"></i> Add Video Link
            </button>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function addVideoLink() {
            const container = document.getElementById('video-links');
            const wrapper = document.createElement('div');
            wrapper.className = 'input-group mb-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'link_video[]';
            input.className = 'form-control';
            input.placeholder = 'Enter video link (e.g. https://youtube.com/watch?v=...)';

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
    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif
@endsection
