@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Detail Brand</h2>
            <a class="btn btn-primary mb-3" href="{{ route('brands.index') }}"> Back</a>
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

    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br>
        <span>General</span>
        <div class="form-group">
            <label for="name">Brand Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
        </div>

        <div class="form-group">
            <label for="handle_by">Handle By:</label>
            <input type="text" name="handle_by" class="form-control" value="{{ $brand->handle_by }}">
        </div>

        <div class="form-group">
            <strong>category:</strong>
            <select name="category_id" class="form-control">
                <option value="{{$brand->category_id}}">{{$brand->category_name}}</option>
                @foreach ($category as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image_brand">Image of Brand:</label>
            @if ($brand->image_brand)
            <img src="{{ $brand->image_brand }}" alt="{{ $brand->name }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image_brand" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control" rows="5">{{$brand->description}}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update General</button>
    </form>

    <form action="{{ route('brands.update-target', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')
        <br>
        <span>Target</span>
        <div class="form-group">
            <label for="sq_target">SQ Target:</label>
            <input type="text" step="0.01" name="sq_target" class="form-control" value="{{ $brand->sq_target }}">
        </div>

        <div class="form-group">
            <label for="so_target">SO Target:</label>
            <input type="text" step="0.01" name="so_target" class="form-control" value="{{ $brand->so_target }}">
        </div>

        <div class="form-group">
            <label for="sales_target">Sales Target:</label>
            <input type="text" step="0.01" name="sales_target" class="form-control" value="{{ $brand->sales_target }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Targets</button>
    </form>
</div>
@endsection