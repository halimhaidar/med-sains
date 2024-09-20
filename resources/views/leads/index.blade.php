@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Leads</h2>
            <a class="btn btn-success mb-3" href="{{ route('leads.create') }}">Create New Lead</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contact Name</th>
                <th>Contact Phone</th>
                <th>Contact Email</th>
                <th>Company</th>
                <th>Source</th>
                <th>Segment</th>
                <th>Status</th>
                <th>Assign To</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
            <tr>
                <td>{{ $lead->id}}</td>
                <td>{{ $lead->contact_name }}</td>
                <td>{{ $lead->contact_phone }}</td>
                <td>{{ $lead->contact_email }}</td>
                <td>{{ $lead->contact_company }}</td>
                <td>{{ $lead->source }}</td>
                <td>{{ $lead->segment }}</td>
                <td>{{ ucfirst($lead->status) }}</td>
                <td>{{ $lead->fullname }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('leads.show', $lead->id) }}">Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('leads.edit', $lead->id) }}">Edit</a>
                    <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
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
