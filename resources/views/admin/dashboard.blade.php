@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Users</h5>
                        <h2>{{ $users->count() }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Modules</h5>
                        <h2>{{ $modules->count() }}</h2>
                    </div>
                    <i class="fas fa-book fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <span>Latest Users</span>
                    <a href="{{ route('users') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View All</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-sm" id="users-table">
                        <thead class="thead-light">
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
                                <td>
                                    <span class="badge {{ $user->id_level == 1 ? 'badge-primary' : 'badge-secondary' }}">
                                        {{ $user->id_level == 1 ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span>Latest Modules</span>
                    <a href="{{ route('modules.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View All</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-sm" id="modules-table">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>File</th>
                                <th>Video Links</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules->sortByDesc('created_at')->take(5) as $module)
                            <tr>
                                <td>{{ $module->name }}</td>
                                <td>
                                    @if($module->file)
                                        <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $videoRaw = $module->link_video;
                                        $videos   = is_string($videoRaw) ? json_decode($videoRaw, true) : ($videoRaw ?? []);
                                    @endphp

                                    @foreach($videos as $v)
                                        @php
                                            $href  = is_array($v) ? ($v['url'] ?? '') : $v;
                                            $title = is_array($v) ? ($v['title'] ?? 'Video') : 'Video';

                                            if ($href && !preg_match('#^[a-z][a-z0-9+.\-]*://#i', $href) && !\Illuminate\Support\Str::startsWith($href, ['//','/','#'])) {
                                                $href = '//' . ltrim($href, '/');
                                            }

                                            $isYoutube = $href ? \Illuminate\Support\Str::contains($href, ['youtube.com', 'youtu.be']) : false;
                                        @endphp

                                        @if($href)
                                            <a href="{{ $href }}" target="_blank" rel="noopener"
                                               class="badge {{ $isYoutube ? 'badge-danger' : 'badge-warning' }} mb-1">
                                                @if($isYoutube)<i class="fab fa-youtube"></i> YouTube @else {{ $title }} @endif
                                            </a>
                                        @endif
                                    @endforeach
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                searching: false,
                paging: false,
                info: false
            });
            $('#modules-table').DataTable({
                searching: false,
                paging: false,
                info: false
            });
            @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
            @endif
        });
    </script>
@endsection
