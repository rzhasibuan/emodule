@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Penilaian Jawaban Essay</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('admin.essay-results') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <div class="section-body">
        <div class="mb-4">
            <strong>Nama User:</strong> {{ $quizResult->user->name ?? '-' }}<br>
            <strong>Modul:</strong> {{ $quizResult->module->name ?? '-' }}<br>
            <strong>Tanggal:</strong> {{ $quizResult->created_at->format('d-m-Y H:i') }}
        </div>
        <form action="{{ route('admin.essay-results.grade.store', $quizResult) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    @foreach($answers as $i => $ans)
                        @if($ans['type'] === 'essay')
                            <div class="mb-4">
                                <label class="font-semibold">Soal {{ $loop->iteration }}:</label>
                                <div class="mb-2">{!! nl2br(e($ans['question'])) !!}</div>
                                <label>Jawaban Siswa:</label>
                                <div class="mb-2 bg-light p-2 rounded">{!! nl2br(e($ans['user_answer'] ?? '-')) !!}</div>
                                <label>Kunci Jawaban:</label>
                                <div class="mb-2 bg-light p-2 rounded">{!! nl2br(e($ans['correct_answer'] ?? '-')) !!}</div>
                                <label for="score_{{ $i }}">Nilai:</label>
                                <input type="number" min="0" max="100" name="scores[{{ $i }}]" id="score_{{ $i }}" class="form-control w-25 d-inline-block" value="{{ $ans['score'] ?? '' }}" required>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan Nilai</button>
        </form>
    </div>
@endsection

