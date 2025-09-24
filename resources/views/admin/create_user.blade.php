@extends('layouts.main')

@section('container')
<div class="section-header">
    <h1>Tambah User Baru</h1>
</div>
<div class="section-body">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_level">Level</label>
            <select name="id_level" id="id_level" class="form-control" required>
                <option value="">-- Pilih Level --</option>
                <option value="1">Admin</option>
                <option value="2">User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('users') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

