@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Users</h1>
    </div>
    <table id="example2" class="table table-hover table-striped table-border">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>User Level</th>
                <th>Email</th>
                <th>Last Update</th>
                <?php 
                if(Auth::user()->id_level == '1'){
                    echo "<th>Action </th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ ($data->id_level === 1) ? 'Admin' : 'User' }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->updated_at->format('d M Y') }}</td>
                <?php 
                if(Auth::user()->id_level == '1'){
                ?>
                    <td>
                        <a href='/showuser/{{ $data->id_users }}' class='btn btn-sm btn-primary' ><i class='fas fa-edit'></i></a>
                        <a href='#' class='btn btn-sm btn-danger delete' data-id='{{ $data->id_users }}' data-name='{{ $data->name }}'><i class="fas fa-trash"></i></a>
                    </td>
                <?php ;} ?>
            </tr>
            @endforeach
            
        </tbody>
        </table>
@endsection