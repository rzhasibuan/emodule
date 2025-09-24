@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Daftar Hasil Quiz Essay</h1>
    </div>
    <div class="section-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Modul</th>
                        <th>Tanggal</th>
                        <th>Nilai Essay</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result->user->name ?? '-' }}</td>
                            <td>{{ $result->module->name ?? '-' }}</td>
                            <td>{{ $result->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($result->score_essay !== null)
                                    {{ $result->score_essay }}
                                @else
                                    <span class="text-warning">Belum dinilai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.essay-results.grade', $result) }}" class="btn btn-sm btn-primary">Nilai</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada hasil quiz essay.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

