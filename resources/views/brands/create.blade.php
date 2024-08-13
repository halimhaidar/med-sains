@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Add New Brand</h2>
            <a class="btn btn-primary" href="{{ route('brands.index') }}"> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Brand Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Enter Brand name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Handle By:</strong>
                    <input type="text" name="handle_by" class="form-control" placeholder="Enter Handle By">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Group:</strong>
                    <select name="group" class="form-control">
                        <option value="">Select Brand Group</option>
                        <option value="Group 1">Group 1</option>
                        <option value="Group 2">Group 2</option>
                        <!-- Add your options here -->
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Image of Brand:</strong>
                    <input type="file" name="image_brand" class="form-control">
                </div>
            </div>
          
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
