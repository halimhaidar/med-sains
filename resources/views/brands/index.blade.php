@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Brands</h2>
            <a class="btn btn-success mb-3" href="{{ route('brands.create') }}">Create New Brand</a>
        </div>
    </div>
    <form  method="GET" action="{{ route('brands.index') }}">
            <label for="search" >Search</label>
            <div class="relative">
                
                <input type="search" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Search" />
                <button type="submit">Search</button>
            </div>
        </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>SQ Target</th>
                <th>SO Target</th>
                <th>Sales Target</th>
                <th>Category</th>
                <th>Created</th>
                <th>Handle By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <!-- Placeholder for Brand initials -->
                        <div class="brand-initials">
                            {{ strtoupper(substr($brand->name, 0, 2)) }}
                        </div>
                        <div class="ml-2">
                            <strong>{{ $brand->name }}</strong><br>
                        </div>
                    </div>
                </td>
                <td>Rp. {{ number_format($brand->sq_target, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($brand->so_target, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($brand->sales_target, 0, ',', '.') }}</td>
                <td>{{ $brand->category_name }}</td>
                <td>{{ $brand->created_at->format('d F Y') }}</td>
                <td>{{ $brand->handle_by }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('brands.show', $brand->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
