@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <h2>Create Quotation</h2>
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

    <form class="max-w-md" method="GET" action="{{ route('quotations.create') }}">
        
        <label for="lead_id">Lead reference:</label>
        <!-- <input type="search" id="search" name="search" value="{{ request('search') }}" placeholder="Contact Name" /> -->
        <select name="lead_id">
            <option value=""disabled selected>Contact Name</option>
            @foreach ($leads as $item)
            <option value="{{ $item->id }}" {{ (isset($data) && $item->id == $data->lead_id) ? 'selected' : '' }}>
                {{ $item->contact_name }}
            </option>
            @endforeach
        </select>
        <button type="submit">Choose</button>
    </form>

    <form action="{{ route('quotations.store') }}" method="POST">
        @csrf
        <!-- section contact -->
        <h3>1. Contact Info</h3>
        <div class="form-group">
            <label for="lead_id">lead id:</label>
            <input type="text" name="lead_id" class="form-control" value="{{ isset($data)?$data->lead_id:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="contact_id">contact id:</label>
            <input type="text" name="contact_id" class="form-control" value="{{ isset($data)?$data->contact_id:''}}" readonly>
        </div>

        <div class="form-group">
            <label for="contact_name">Contact Name:</label>
            <input type="text" name="contact_name" class="form-control" value="{{ isset($data)?$data->contact_name:''}}" readonly>
        </div>

        <div class="form-group">
            <label for="company">Company:</label>
            <input type="text" name="company" class="form-control" value="{{ isset($data)?$data->company_name:''}}" readonly>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" value="{{ isset($data)?$data->contact_email:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="contact_address">address:</label>
            <input type="text" name="contact_address" class="form-control" value="{{ isset($data)?$data->contact_address:''}}">
        </div>
        <div class="form-group">
            <label for="contact_province">province:</label>
            <input type="text" name="contact_province" class="form-control" value="{{ isset($data)?$data->contact_province:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="contact_city">city:</label>
            <input type="text" name="contact_city" class="form-control" value="{{ isset($data)?$data->contact_city:''}}" readonly>
        </div>

        <div class="form-group">
            <label for="contact_post_code">post code:</label>
            <input type="text" name="contact_post_code" class="form-control" value="{{ isset($data)?$data->contact_post_code:''}}" readonly>
        </div>

        <!-- section general data -->
        <h3>2. General Data</h3>
        <div class="form-group">
            <label for="category">Category : </label>
            <select name="category">
                <option value="" disabled selected>Choose</option>
                @foreach ($quotation_category as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="source">Source : </label>
            <select name="source">
                <option value="" disabled selected>Choose</option>
                @foreach ($quotation_source as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="closing_date_target">Closing Date Target:</label>
            <input type="date" name="closing_date_target" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description: </label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <!-- section general data -->
        <h3>3. Offer Condition</h3>
        <div class="form-group">
            <label for="franco">Franco :</label>
            <input type="text" name="franco" class="form-control">
        </div>

        <div class="form-group">
            <label for="validity">Validity :</label>
            <input type="text" name="validity" class="form-control">
        </div>

        <div class="form-group">
            <label for="delivery_estimation">Delivery Estimation :</label>
            <input type="text" name="delivery_estimation" class="form-control">
        </div>

        <div class="form-group">
            <label for="delivery_conditon">Delivery Conditon : </label>
            <select name="delivery_conditon">
                <option value="" disabled selected>Choose</option>
                @foreach ($dev_con as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="term_of_payment">Term of Payment : </label>
            <select name="term_of_payment">
                <option value="" disabled selected>Choose</option>
                @foreach ($top as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>

        <h3>Products item</h3>
       


        <button type="submit" class="btn btn-success">Create Quotation</button>
    </form>

    <form action="{{ route('quotations.addAddress') }}" method="POST">
        @csrf
        <h3>Add New Address</h3>
        <div class="form-group">
            <input type="text" name="lead_id" class="form-control" value="{{ isset($data)?$data->lead_id:''}}" hidden>
        </div>
        <div class="form-group">
            <input type="text" name="contact_id" class="form-control" value="{{ isset($data)?$data->contact_id:''}}" hidden>
        </div>
        <div class="form-group">
            <label for="contact_province">province:</label>
            <input type="text" name="contact_province" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact_city">city:</label>
            <input type="text" name="contact_city" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact_address">address:</label>
            <input type="text" name="contact_address" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact_post_code">post code:</label>
            <input type="text" name="contact_post_code" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save Address</button>
    </form>
</div>

@endsection