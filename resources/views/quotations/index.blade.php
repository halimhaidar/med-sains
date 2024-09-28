@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <h2>Quotations</h2>
            <a class="btn btn-success mb-3" href="{{ route('quotations.create') }}">Create New Quotation</a>
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
                <th>Lead ID</th>
                <th>Contact Address ID</th>
                <th>Category</th>
                <th>Closing Date Target</th>
                <th>Source</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotations as $quotation)
            <tr>
                <td>{{ $quotation->id }}</td>
                <td>{{ $quotation->lead_id }}</td>
                <td>{{ $quotation->contact_address_id }}</td>
                <td>{{ $quotation->category }}</td>
                <td>{{ $quotation->closing_date_target }}</td>
                <td>{{ $quotation->source }}</td>
                <td>{{ $quotation->description }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('quotations.show', $quotation->id) }}">Show</a>
                    <form action="{{ route('quotations.destroy', $quotation->id) }}" method="POST" style="display:inline;">
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
