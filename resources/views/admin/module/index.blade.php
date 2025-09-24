@extends('layouts.main')

@section('container')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Modules</h1>
        <a href="{{ route('modules.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Module</a>
    </div>
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="table-responsive">
        <table id="modules-table" class="table table-hover table-striped table-border">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>File</th>
                    <th>Image</th>
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
                    <td>{{ $module->category ?? '-' }}</td>
                    <td>{{ Str::limit($module->description, 50) ?? '-' }}</td>
                    <td>{{ $module->author ?? '-' }}</td>
                    <td>
                        @if($module->file)
                            <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">View PDF</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($module->image)
                            <img src="{{ asset('storage/' . $module->image) }}" alt="Module Image" class="img-thumbnail" width="50">
                        @else
                            -
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

                                if ($href && !preg_match('#^[a-z][a-z0-9+.\-]*://#i', $href) && !in_array($href[0], ['/', '#'])) {
                                    $href = '//' . ltrim($href, '/');
                                }
                            @endphp

                            @if($href)
                                <a href="{{ $href }}" target="_blank" rel="noopener" class="badge badge-warning mb-1">{{ $title }}</a>
                            @endif
                        @endforeach
                    </td>

                    <td>{{ $module->updated_at->format('d M Y') }}</td>
                    @if(Auth::user()->id_level == 1)
                    <td>
                        <a href="{{ route('modules.show', $module->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $('#modules-table').DataTable({
                pageLength: 10,
                order: [[0, 'asc']],
                responsive: true
            });
            // SweetAlert for delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will delete the module permanently!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
