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
            <option value="" disabled selected>Contact Name</option>
            @foreach ($leads as $item)
            <option value="{{ $item->id }}" {{ (isset($data) && $item->id == $data->lead_id) ? 'selected' : '' }}>
                {{ $item->contact_name }}
            </option>
            @endforeach
        </select>
        <button type="submit">Choose</button>
    </form>

    <!-- section contact -->
    <form action="{{ route('quotations.nextStep') }}" method="POST">
        @csrf

        <h3>1. Contact Info</h3>
        <div class="form-group">
            <label for="type">type:</label>
            <input type="text" name="type" class="form-control" value="contact_info" readonly>
        </div>
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
            <label for="contact_address_id">Contact Address : </label>
            <select name="contact_address_id">
                <option value="" disabled selected>Choose</option>
                @if($list_address && $list_address->isNotEmpty())
                @foreach ($list_address as $item)
                <option value="{{ $item->id }}" {{ $item->default == 1 ? 'selected' : '' }}>
                    {{ $item->address }}
                </option>
                @endforeach
                @else
                <option value="" disabled>No addresses available</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="contact_province">province:</label>
            <input type="text" name="contact_province" class="form-control" value="{{ isset($data)?$data->contact_province:''}}" disbaled>
        </div>
        <div class="form-group">
            <label for="contact_city">city:</label>
            <input type="text" name="contact_city" class="form-control" value="{{ isset($data)?$data->contact_city:''}}" disbaled>
        </div>

        <div class="form-group">
            <label for="contact_post_code">post code:</label>
            <input type="text" name="contact_post_code" class="form-control" value="{{ isset($data)?$data->contact_post_code:''}}" disbaled>
        </div>
        <div class="form-group">
            <label for="contact_post_code">Quotation id:</label>
            <input type="text" name="id" class="form-control" value="{{ isset($quotation)?$quotation->id:''}}" disbaled>
        </div>
        <br>
        <button type="submit" class="btn btn-success">next</button>
    </form>

    <!-- add New Address -->
    <form action="{{ route('quotations.addAddress') }}" method="POST">
        @csrf
        <h3>Add New Address</h3>
        <div class="form-group">
            <input type="text" name="contact_id" class="form-control" value="{{ isset($data)?$data->contact_id:''}}" hidden>
        </div>
        <div class="form-group">
            <label for="contact_province">province:</label>
            <input type="text" name="province" class="form-control">
        </div>
        <div class="form-group">
            <label for="city">city:</label>
            <input type="text" name="city" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">address:</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="post_code">post code:</label>
            <input type="text" name="post_code" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">phone:</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save Address</button>
    </form>

    <!-- section general data -->
    <form action="{{ route('quotations.nextStep') }}" method="POST">
        @csrf
        <h3>2. General Data</h3>
        <div class="form-group">
            <label for="type">type:</label>
            <input type="text" name="type" class="form-control" value="general_data" readonly>
        </div>
        <div class="form-group">
            <label for="contact_post_code">Quotation id:</label>
            <input type="text" name="id" class="form-control" value="{{ isset($quotation)?$quotation->id:''}}" disbaled>
        </div>
        <div class="form-group">
            <label for="category">Category : </label>
            <select name="category">
                <option value="" disabled selected>Choose</option>
                @foreach ($quotation_category as $item)
                <option value="{{ $item }}" {{ (isset($quotation) && $item == $quotation->category) ? 'selected' : '' }}>
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
                <option value="{{ $item }}" {{ (isset($quotation) && $item == $quotation->source) ? 'selected' : '' }}>
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="closing_date_target">Closing Date Target:</label>
            <input type="date" name="closing_date_target" class="form-control" value="{{ isset($quotation)?$quotation->closing_date_target:''}}">
        </div>

        <div class="form-group">
            <label for="description">Description: </label>
            <textarea name="description" class="form-control">{{ isset($quotation)?$quotation->description:''}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">next</button>

    </form>


    <!-- section Offer Condition -->
    <form action="{{ route('quotations.nextStep') }}" method="POST">
        @csrf
        <h3>3. Offer Condition</h3>
        <div class="form-group">
            <label for="type">type:</label>
            <input type="text" name="type" class="form-control" value="offer_condition" readonly>
        </div>
        <div class="form-group">
            <label for="contact_post_code">Quotation id:</label>
            <input type="text" name="id" class="form-control" value="{{ isset($quotation)?$quotation->id:''}}" disbaled>
        </div>
        <div class="form-group">
            <label for="franco">Franco :</label>
            <input type="text" name="franco" class="form-control" value="{{ isset($quotation)?$quotation->franco:''}}">
        </div>

        <div class="form-group">
            <label for="validity">Validity :</label>
            <input type="text" name="validity" class="form-control" value="{{ isset($quotation)?$quotation->validity:''}}">
        </div>

        <div class="form-group">
            <label for="delivery_estimation">Delivery Estimation :</label>
            <input type="date" name="delivery_estimation" class="form-control" value="{{ isset($quotation)?$quotation->validity:''}}">
        </div>

        <div class="form-group">
            <label for="delivery_condition">Delivery Conditon : </label>
            <select name="delivery_condition">
                <option value="" disabled selected>Choose</option>
                @foreach ($dev_con as $item)
                <option value="{{ $item }}" {{ (isset($quotation) && $item == $quotation->delivery_condition) ? 'selected' : '' }}>
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
                <option value="{{ $item }}" {{ (isset($quotation) && $item == $quotation->term_of_payment) ? 'selected' : '' }}>
                    {{ $item }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">next step</button>
    </form>

    <!-- section Product Item -->
    <form action="{{ route('quotations.nextStep') }}" method="POST">
        @csrf
        <h3>4. Product Items</h3>
        <div class="form-group">
            <label for="type">type:</label>
            <input type="text" name="type" class="form-control" value="product_item" readonly>
        </div>
        <div class="form-group">
            <label for="contact_post_code">Quotation id:</label>
            <input type="text" name="id" class="form-control" value="{{ isset($quotation)?$quotation->id:''}}" disbaled>
        </div>
        <label for="product_id">Product List:</label>

        <select name="product_id">
            <option value="" disabled selected>List Product</option>
            @foreach ($listProducts as $item)
            <option value="{{ $item->id }}">
                {{ $item->name }}
            </option>
            @endforeach
        </select>

        @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin') <!-- Check if the user is admin -->
        <div class="form-group">
            <label for="sales_id">Sales:</label>
            <select class="form-control" id="sales_id" name="sales_id" >
            <option value="" disabled selected>Choose </option>
                @foreach($user as $item)
                <option value="{{ $item->id }}" {{ (isset($quotation) && $item->id == $quotation->sales_id) ? 'selected' : '' }}>
                    {{ $item->fullname }}
                </option>
                @endforeach
            </select>
        </div>
        @else
        <div class="form-group">
            <label for="sales_id">Sales:</label>
            <input type="text" name="sales_id" class="form-control" value="{{$user->fullname}}">
        </div>
        @endif

        <button type="submit" class="btn btn-success">Create Quotation</button>

    </form>


</div>

@endsection