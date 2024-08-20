@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Detail Product</h2>
            <a class="btn btn-primary mb-3" href="{{ route('products.index') }}">Back</a>
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


    <form class="p-4 md:p-5" action="{{ route('products.update', $product->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="{{$product->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="catalog">Catalog:</label>
            <input type="text" name="catalog" value="{{$product->category}}" class="form-control">
        </div>
        <div class="form-group">
            <label>category:</label>
            <select name="category" class="form-control" value="{{$product->category}}">
                <option value="{{$product->category}}" disabled selected>{{$product->category}}</option>
                <option value="Assykit">Assykit</option>
                <option value="Instrument">Instrument</option>
                <option value="Consumable">Consumable</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Brand:</label>
            <select name="brand_id" class="form-control">
                <option selected value="{{ $product->brand_id }}">{{ $product->brand_name }}</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Ecatalog Link:</label>
            <textarea name="ecatalog_link" class="form-control" rows="5">{{$product->ecatalog_link}}</textarea>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" rows="5">{{$product->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Attachment:</label>
            @if ($product->attachment)
                <a href="{{ asset('uploads/files/' . $product->attachment) }}" target="_blank">View Current Attachment</a><br>
            @endif
            <input type="file" name="attachment" class="form-control">
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="" disabled selected>Select Status</option>
                <option value="active">Active</option>
                <option value="non_active">Non Active</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" value="{{$product->price}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="stock">stock:</label>
            <input type="text" name="stock" value="{{$product->stock}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="safety_stock">safety stock:</label>
            <input type="text" name="safety_stock" value="{{$product->safety_stock}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>