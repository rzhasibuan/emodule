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

        {{-- Quiz Links --}}
        <div class="form-group">
            <label>Quiz Links</label>

            @php
                // Bisa array (casts) atau string JSON lama
                $quizLinksRaw = $module->link_quiz;
                $quizLinksArr = is_string($quizLinksRaw) ? json_decode($quizLinksRaw, true) : ($quizLinksRaw ?? []);
                if (!is_array($quizLinksArr)) $quizLinksArr = [];
                // Bentuk input: array of strings (URL)
                // Jika item berupa object {title,url}, ambil url-nya untuk form sederhana
                $quizLinksArr = array_map(function($item) {
                    return is_array($item) ? ($item['url'] ?? '') : $item;
                }, $quizLinksArr);
            @endphp

            <div id="quiz-links">
                @forelse($quizLinksArr as $i => $val)
                    <div class="input-group mb-2">
                        <input type="text" name="link_quiz[]" class="form-control"
                               value="{{ old('link_quiz.' . $i, $val) }}"
                               placeholder="Enter quiz link (e.g. https://example.com/quiz)">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @empty
                    {{-- kalau kosong, tampilkan satu field kosong --}}
                    <div class="input-group mb-2">
                        <input type="text" name="link_quiz[]" class="form-control"
                               value="{{ old('link_quiz.0') }}"
                               placeholder="Enter quiz link (e.g. https://example.com/quiz)">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.input-group').remove()">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <button type="button" class="btn btn-sm btn-info mt-2" onclick="addQuizLink()">
                <i class="fas fa-plus"></i> Add Quiz Link
            </button>
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
        function addQuizLink() {
            const container = document.getElementById('quiz-links');
            const wrapper = document.createElement('div');
            wrapper.className = 'input-group mb-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'link_quiz[]';
            input.className = 'form-control';
            input.placeholder = 'Enter quiz link (e.g. https://example.com/quiz)';

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
