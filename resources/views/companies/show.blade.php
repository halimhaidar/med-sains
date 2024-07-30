<!-- resources/views/companies/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Company Details</h2>
        <div class="card">
            <div class="card-header">
                <h3>{{ $company->company }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Sales Creator:</strong> {{ $company->created_by }}</p>
                <p><strong>Sales PIC:</strong> {{ $company->created_by }}</p>
                <p><strong>Created:</strong> {{ $company->created_at }}</p>
                <p><strong>Phone:</strong> {{ $company->phone }}</p>
                <p><strong>Address:</strong> {{ $company->address }}</p>
            </div>
        </div>
        <a href="{{ route('companies.index') }}">Back to List</a>
    </div>
@endsection
