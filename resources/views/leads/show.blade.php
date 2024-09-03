@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <h2>Lead Details</h2>
            <a class="btn btn-primary mb-3" href="{{ route('leads.index') }}">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Lead Information
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $lead->id }}</p>
            <p><strong>Contact ID:</strong> {{ $lead->contact_id }}</p>
            <p><strong>Contact Name:</strong> {{ $lead->contact_name }}</p>
            <p><strong>Contact Phone:</strong> {{ $lead->contact_phone }}</p>
            <p><strong>Contact Email:</strong> {{ $lead->contact_email }}</p>
            <p><strong>Contact Company:</strong> {{ $lead->contact_company }}</p>
            <p><strong>Source:</strong> {{ $lead->source }}</p>
            <p><strong>Segment:</strong> {{ $lead->segment }}</p>
            <p><strong>Status:</strong> {{ ucfirst($lead->status) }}</p>
            <p><strong>Description:</strong> {{ $lead->description }}</p>
            <p><strong>Assign To:</strong> {{ $lead->assign_to }}</p>
            <p><strong>Created At:</strong> {{ $lead->created_at->format('d-m-Y H:i:s') }}</p>
            <p><strong>Updated At:</strong> {{ $lead->updated_at->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</div>
@endsection
