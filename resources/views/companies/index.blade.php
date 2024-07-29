@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Companies</h2>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Add New Company</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Division</th>
                <th>Phone</th>
                <th>Segment</th>
                <th>Sub Segment</th>
                <th>Website</th>
                <th>Social Media</th>
                <th>Npwp</th>
                <th>Post Code</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company }}</td>
                <td>{{ $company->division }}</td>
                <td>{{ $company->phone }}</td>
                <td>{{ $company->segment }}</td>
                <td>{{ $company->sub_segment }}</td>
                <td>{{ $company->website }}</td>
                <td>{{ $company->social_media }}</td>
                <td>{{ $company->npwp }}</td>
                <td>{{ $company->post_code }}</td>
                <td>{{ $company->address }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
