@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Company</h2>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" required>
            </div>
            <div class="form-group">
                <label for="division">Division</label>
                <input type="text" class="form-control" id="division" name="division">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+"
                    title="Only numbers are allowed">
            </div>
            <div class="form-group">
                <label for="segment">Segment</label>
                <input type="text" class="form-control" id="segment" name="segment" required>
            </div>
            <div class="form-group">
                <label for="sub_segment">Sub Segment</label>
                <input type="text" class="form-control" id="sub_segment" name="sub_segment">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>
            <div class="form-group">
                <label for="social_media">Social Media</label>
                <input type="text" class="form-control" id="social_media" name="social_media">
            </div>
            <div class="form-group">
                <label for="npwp">Npwp</label>
                <input type="text" class="form-control" id="npwp" name="npwp">
            </div>
            <div class="form-group">
                <label for="post_code">Post Code</label>
                <input type="text" class="form-control" id="post_code" name="post_code" pattern="[0-9]+"
                    title="Only numbers are allowed">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
