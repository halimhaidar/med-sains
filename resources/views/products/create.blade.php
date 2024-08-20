@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Create Product</h2>
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


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="catalog">Catalog:</label>
            <input type="text" name="catalog" class="form-control">
        </div>
        <div class="form-group">
            <label>category:</label>
            <select name="category" class="form-control">
                <option value="" disabled selected>Select category</option>
                <option value="Assykit">Assykit</option>
                <option value="Instrument">Instrument</option>
                <option value="Consumable">Consumable</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Brand Name:</label>
            <select name="brand_id" class="form-control">
                <option value="" disabled selected>Select Brand</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Ecatalog Link:</label>
            <textarea name="ecatalog_link" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Attachment:</label>
            <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>