@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Daftar Hasil Quiz</h1>
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
                        <th>Jenis Quiz</th>
                        <th>Nilai MC</th>
                        <th>Nilai Essay</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        @php
                            $answers = collect(json_decode($result->answers, true));
                            $hasEssay = $answers->where('type', 'essay')->count() > 0;
                            $hasMC = $answers->where('type', 'multiple_choice')->count() > 0;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result->user->name ?? '-' }}</td>
                            <td>{{ $result->module->name ?? '-' }}</td>
                            <td>{{ $result->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($hasEssay && $hasMC)
                                    <span class="badge badge-info">Campuran</span>
                                @elseif($hasEssay)
                                    <span class="badge badge-warning">Essay</span>
                                @else
                                    <span class="badge badge-primary">Pilihan Ganda</span>
                                @endif
                            </td>
                            <td>{{ $result->score }}</td>
                            <td>
                                @if($hasEssay)
                                    {{ $result->score_essay !== null ? $result->score_essay : 'Belum dinilai' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($hasEssay)
                                    <a href="{{ route('admin.essay-results.grade', $result) }}" class="btn btn-sm btn-primary">Nilai Essay</a>
                                @else
                                    <a href="{{ route('module.quiz.results', $result) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

