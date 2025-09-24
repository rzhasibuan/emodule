@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Edit Module</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-primary">Back to List</a>
    </div>

    <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $module->name) }}"
                placeholder="Module name">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Category --}}
        <div class="form-group">
            <label for="category">Category</label>
            <input
                type="text"
                name="category"
                id="category"
                class="form-control @error('category') is-invalid @enderror"
                value="{{ old('category', $module->category) }}"
                placeholder="Module category (e.g., Matematika, IPA)">
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="3"
                placeholder="Module description">{{ old('description', $module->description) }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Author --}}
        <div class="form-group">
            <label for="author">Author</label>
            <input
                type="text"
                name="author"
                id="author"
                class="form-control @error('author') is-invalid @enderror"
                value="{{ old('author', $module->author) }}"
                placeholder="Module author">
            @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- File --}}
        <div class="form-group">
            <label for="file">File (PDF only)</label>
            @if($module->file)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-file-pdf"></i> Current File
                    </a>
                    <span class="text-muted ml-2">{{ $module->file }}</span>
                </div>
            @endif
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" accept="application/pdf">
            <small class="form-text text-muted">Leave blank to keep current file.</small>
            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Image --}}
        <div class="form-group">
            <label for="image">Module Image</label>
            @if($module->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $module->image) }}" alt="Module Image" class="img-thumbnail" width="150">
                    <span class="text-muted ml-2">{{ $module->image }}</span>
                </div>
            @endif
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
            <small class="form-text text-muted">Leave blank to keep current image. Max 2MB. (jpeg, png, jpg, gif, svg)</small>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Video Links --}}
        <div class="form-group">
            <label>Video Links</label>

            @php
                $videoLinksRaw = $module->link_video;
                $videoLinksArr = is_string($videoLinksRaw) ? json_decode($videoLinksRaw, true) : ($videoLinksRaw ?? []);
                if (!is_array($videoLinksArr)) $videoLinksArr = [];
                $videoLinksArr = array_map(function($item) {
                    return is_array($item) ? ($item['url'] ?? '') : $item;
                }, $videoLinksArr);
            @endphp

            <div id="video-links">
                @forelse($videoLinksArr as $i => $val)
                    <div class="input-group mb-2">
                        <input type="text" name="link_video[]" class="form-control"
                               value="{{ old('link_video.' . $i, $val) }}"
                               placeholder="Enter video link (e.g. https://youtube.com/watch?v=...)">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="input-group mb-2">
                        <input type="text" name="link_video[]" class="form-control"
                               value="{{ old('link_video.0') }}"
                               placeholder="Enter video link (e.g. https://youtube.com/watch?v=...)">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <button type="button" class="btn btn-sm btn-info mt-2" onclick="addVideoLink()">
                <i class="fas fa-plus"></i> Add Video Link
            </button>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

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
@endsection
