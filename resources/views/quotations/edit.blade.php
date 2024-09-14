@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <h2>Edit Quotation</h2>
            <a class="btn btn-primary mb-3" href="{{ route('quotations.index') }}">Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('quotations.update', $quotation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Add input fields for all the columns with prefilled values -->

        <div class="form-group">
            <label for="lead_id">Lead ID:</label>
            <input type="text" name="lead_id" class="form-control" value="{{ $quotation->lead_id }}" required>
        </div>

        <div class="form-group">
            <label for="contact_address_id">Contact Address ID:</label>
            <input type="text" name="contact_address_id" class="form-control" value="{{ $quotation->contact_address_id }}">
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" class="form-control" value="{{ $quotation->category }}">
        </div>

        <div class="form-group">
            <label for="closing_date_target">Closing Date Target:</label>
            <input type="date" name="closing_date_target" class="form-control" value="{{ $quotation->closing_date_target }}">
        </div>

        <div class="form-group">
            <label for="source">Source:</label>
            <input type="text" name="source" class="form-control" value="{{ $quotation->source }}">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control">{{ $quotation->description }}</textarea>
        </div>

        <!-- Add more fields as necessary -->

        <button type="submit" class="btn btn-success">Update Quotation</button>
    </form>
</div>
@endsection
