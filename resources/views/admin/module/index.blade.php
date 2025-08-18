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
                    <th>File</th>
                    <th>Quiz Link</th>
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
                    <td>
                        @if($module->file)
                            <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">View PDF</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @foreach(json_decode($module->link_quiz ?? '[]', true) as $link)
                            <a href="{{ $link }}" target="_blank" class="badge badge-info mb-1">Quiz</a>
                        @endforeach
                    </td>
                    <td>
                        @foreach(json_decode($module->link_video ?? '[]', true) as $link)
                            <a href="{{ $link }}" target="_blank" class="badge badge-warning mb-1">Video</a>
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
