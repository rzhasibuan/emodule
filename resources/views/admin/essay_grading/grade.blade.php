@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Form Penilaian Essay</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('admin.essay-grading') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <div class="section-body">
        <div class="mb-4">
            <strong>Nama User:</strong> {{ $quizResult->user->name ?? '-' }}<br>
            <strong>Modul:</strong> {{ $quizResult->module->name ?? '-' }}<br>
            <strong>Tanggal:</strong> {{ $quizResult->created_at->format('d-m-Y H:i') }}
        </div>
        <form action="{{ route('admin.essay-grading.grade.store', $quizResult->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    @foreach($essayAnswers as $ans)
                        <div class="mb-4">
                            <label class="font-semibold">Soal {{ $loop->iteration }}:</label>
                            <div class="mb-2">{!! nl2br(e($ans->question)) !!}</div>
                            <label>Kunci Jawaban:</label>
                            <div class="mb-2 bg-light p-2 rounded">{!! nl2br(e(optional($ans->quiz)->answer_key ?? '-')) !!}</div>
                            <label>Jawaban Siswa:</label>
                            <div class="mb-2 bg-light p-2 rounded">{!! nl2br(e($ans->user_answer ?? '-')) !!}</div>
                            <label for="score_{{ $ans->id }}">Nilai:</label>
                            <input type="number" min="0" max="100" name="scores[{{ $ans->id }}]" id="score_{{ $ans->id }}" class="form-control w-25 d-inline-block" value="{{ $ans->score ?? '' }}" required>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan Nilai</button>
        </form>
    </div>
@endsection
