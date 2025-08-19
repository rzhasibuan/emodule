@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Module Details</h1>
        <a href="{{ route('modules.index') }}" class="btn btn-primary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $module->name }}</h5>

            <p class="mb-2">
                <strong>File:</strong>
                @if($module->file)
                    <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        View PDF
                    </a>
                    <span class="text-muted ml-2">{{ $module->file }}</span>
                @else
                    <span class="text-muted">-</span>
                @endif
            </p>

            {{-- QUIZ LINKS --}}
            <div class="mb-3">
                <strong>Quiz Link:</strong>
                @php
                    $quizRaw = $module->link_quiz;                                     // array (casts) atau string JSON lama
                    $quizzes = is_string($quizRaw) ? json_decode($quizRaw, true) : ($quizRaw ?? []);
                @endphp

                @if(is_array($quizzes) && count($quizzes))
                    <div class="mt-2">
                        @foreach($quizzes as $q)
                            @php
                                // Support string URL atau object {title,url}
                                $href  = is_array($q) ? ($q['url'] ?? '') : $q;
                                $title = is_array($q) ? ($q['title'] ?? 'Quiz') : 'Quiz';

                                // Jika tanpa skema (http/https), jadikan absolut agar tidak jadi relatif ke website
                                if ($href && !preg_match('#^[a-z][a-z0-9+.\-]*://#i', $href)
                                    && !\Illuminate\Support\Str::startsWith($href, ['//','/','#'])) {
                                    $href = '//' . ltrim($href, '/');
                                }
                            @endphp
                            @if($href)
                                <a href="{{ $href }}" target="_blank" rel="noopener"
                                   class="badge badge-info mr-1 mb-1">{{ $title }}</a>
                            @endif
                        @endforeach
                    </div>
                @else
                    <span class="text-muted">-</span>
                @endif
            </div>

            {{-- VIDEO LINKS --}}
            <div class="mb-3">
                <strong>Video Link:</strong>
                @php
                    $videoRaw = $module->link_video;
                    $videos   = is_string($videoRaw) ? json_decode($videoRaw, true) : ($videoRaw ?? []);
                @endphp

                @if(is_array($videos) && count($videos))
                    <div class="mt-2">
                        @foreach($videos as $v)
                            @php
                                $href  = is_array($v) ? ($v['url'] ?? '') : $v;
                                $title = is_array($v) ? ($v['title'] ?? 'Video') : 'Video';

                                if ($href && !preg_match('#^[a-z][a-z0-9+.\-]*://#i', $href)
                                    && !\Illuminate\Support\Str::startsWith($href, ['//','/','#'])) {
                                    $href = '//' . ltrim($href, '/');
                                }

                                $isYoutube = $href ? \Illuminate\Support\Str::contains($href, ['youtube.com','youtu.be']) : false;
                            @endphp

                            @if($href)
                                <a href="{{ $href }}" target="_blank" rel="noopener"
                                   class="badge {{ $isYoutube ? 'badge-danger' : 'badge-warning' }} mr-1 mb-1">
                                    @if($isYoutube)
                                        <i class="fab fa-youtube"></i> YouTube
                                    @else
                                        {{ $title }}
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                @else
                    <span class="text-muted">-</span>
                @endif
            </div>

            <p class="mb-1"><strong>Created At:</strong> {{ $module->created_at->format('d M Y') }}</p>
            <p class="mb-3"><strong>Updated At:</strong> {{ $module->updated_at->format('d M Y') }}</p>

            @if(Auth::user()->id_level == 1)
                <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('modules.destroy', $module->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this module?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endsection
