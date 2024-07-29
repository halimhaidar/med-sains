<!-- resources/views/companies/index.blade.php -->

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
                <th>Segment</th>
                <th>Sales PIC</th>
                 <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->division }}</td>
                <td>{{ $company->segment}}</td>
                <td>{{ $company->pic}}</td>
                <td>{{ $company->created_at }}</td>
                <td>{{ $company->company }}</td>
                <td>
                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">Details</a>
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
