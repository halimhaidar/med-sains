@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <h2>Quotation Details</h2>
            <a class="btn btn-primary mb-3" href="{{ route('quotations.index') }}">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Quotation Information
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $quotation->id }}</p>
            <p><strong>Lead ID:</strong> {{ $quotation->lead_id }}</p>
            <p><strong>Contact Address ID:</strong> {{ $quotation->contact_address_id }}</p>
            <p><strong>Category:</strong> {{ $quotation->category }}</p>
            <p><strong>Closing Date Target:</strong> {{ $quotation->closing_date_target }}</p>
            <p><strong>Source:</strong> {{ $quotation->source }}</p>
            <p><strong>Description:</strong> {{ $quotation->description }}</p>
            <!-- Add more fields as necessary -->
            <p><strong>Created At:</strong> {{ $quotation->created_at->format('d-m-Y H:i:s') }}</p>
            <p><strong>Updated At:</strong> {{ $quotation->updated_at->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</div>
@endsection
