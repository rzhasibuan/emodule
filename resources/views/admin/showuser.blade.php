@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Edit User</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route("change_user", $data->id_users)}}">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{ $data->email }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="id_level" class="form-control" required>
                                    <option value="{{ $data->id_level }}">-- <?php if($data->id_level == '1'){echo "Admin";}else{echo "User";};?> --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button Type="submit" name="update" class="btn btn-primary mt-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
