<!-- resources/views/companies/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Company</h2>
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ $company->company }}"
                    required>
            </div>

            <div class="form-group">
                <label for="division">Division</label>
                <input type="text" class="form-control" id="division" name="division" value="{{ $company->division }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $company->phone }}">
            </div>
            <div class="form-group">
                <label for="segment">Segment</label>
                <input type="text" class="form-control" id="segment" name="segment" value="{{ $company->segment }}"
                    required>
            </div>
            <div class="form-group">
                <label for="sub_segment">Sub Segment</label>
                <input type="text" class="form-control" id="sub_segment" name="sub_segment"
                    value="{{ $company->sub_segment }}">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}">
            </div>
            <div class="form-group">
                <label for="social_media">Social Media</label>
                <input type="text" class="form-control" id="social_media" name="social_media"
                    value="{{ $company->social_media }}">
            </div>
            <div class="form-group">
                <label for="npwp">Npwp</label>
                <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $company->npwp }}">
            </div>
            <div class="form-group">
                <label for="post_code">Post Code</label>
                <input type="text" class="form-control" id="post_code" name="post_code"
                    value="{{ $company->post_code }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ $company->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="post_code">Sales PIC</label>
                <input type="text" class="form-control" id="pic" name="pic" value="{{ $company->pic }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
