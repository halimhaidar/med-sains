@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Products</h2>
            <a class="btn btn-success mb-3" href="{{ route('products.create') }}">Create New Product</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <form class="max-w-md" method="GET" action="{{ route('products.index') }}">
        <label for="search" >Search</label>
        <input type="search" id="search" name="search" value="{{ request('search') }}" placeholder="Search" />
        <button type="submit">Search</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->brand_name }}</td>
                <td>Rp. {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ ucfirst($product->created_at) }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('products.show', $product->id) }}">Show</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection