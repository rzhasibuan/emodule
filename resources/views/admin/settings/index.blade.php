@extends('layouts.main')

@section('container')
    <div class="section-header">
        <h1>Website Settings</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Edit Website Content</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="home_title">Home - Title</label>
                            <textarea name="home_title" id="home_title" class="form-control" style="height: 100px;">{{ $settings['home_title']->value ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="home_description">Home - Description</label>
                            <textarea name="home_description" id="home_description" class="form-control" style="height: 100px;">{{ $settings['home_description']->value ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about_title">About - Title</label>
                            <textarea name="about_title" id="about_title" class="form-control" style="height: 100px;">{{ $settings['about_title']->value ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_description">About - Description</label>
                            <textarea name="about_description" id="about_description" class="form-control" style="height: 150px;">{{ $settings['about_description']->value ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_closing_text">About - Closing Text</label>
                            <textarea name="about_closing_text" id="about_closing_text" class="form-control" style="height: 120px;">{{ $settings['about_closing_text']->value ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about_vision_title">About - Vision Title</label>
                            <input type="text" name="about_vision_title" id="about_vision_title" class="form-control" value="{{ $settings['about_vision_title']->value ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="about_vision_description">About - Vision Description</label>
                            <textarea name="about_vision_description" id="about_vision_description" class="form-control" style="height: 100px;">{{ $settings['about_vision_description']->value ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_mission_title">About - Mission Title</label>
                            <input type="text" name="about_mission_title" id="about_mission_title" class="form-control" value="{{ $settings['about_mission_title']->value ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="about_mission_list">About - Mission List (HTML)</label>
                            <textarea name="about_mission_list" id="about_mission_list" class="form-control" style="height: 150px;">{{ $settings['about_mission_list']->value ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
