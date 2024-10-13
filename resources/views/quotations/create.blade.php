@extends('layouts.dashboard')

@section('content')
    <div
        class="w-full text-gray-500 bg-white border border-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">
    </div>
    <ol id="steps"
        class="flex items-center w-full space-x-2 text-sm font-medium text-center sm:text-base m:p-4 sm:space-x-4 rtl:space-x-reverse">
        <li class="step flex items-center w-1/4  border-b-4 border-gray-400">
            <div class="p-4 text-right">
                <span class="text-3xl">
                    1.
                </span>
                <span class="text-lg">
                    Contact Info
                </span>
            </div>
        </li>
        <li class="step flex items-center w-1/4  border-b-4 border-gray-400">
            <div class="p-4 text-right">
                <span class="text-3xl">
                    2.
                </span>
                <span class="text-lg">
                    General Data
                </span>
            </div>
        </li>
        <li class="step flex items-center w-1/4  border-b-4 border-gray-400">
            <div class="p-4 text-right">
                <span class="text-3xl">
                    3.
                </span>
                <span class="text-lg">
                    Offer Condition
                </span>
            </div>
        </li>
        <li class="step flex items-center w-1/4  border-b-4 border-gray-400">
            <div class="p-4 text-right">
                <span class="text-3xl">
                    4.
                </span>
                <span class="text-lg">
                    Product Items
                </span>
            </div>
        </li>
    </ol>
    <form id="step-1" class="p-10" method="GET" action="{{ route('quotations.create') }}">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div class="col-span-2">
                <label for="lead_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lead
                    Reference</label>
                <div class="grid grid-cols-8">
                    <select id="lead_id" name="lead_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" selected>Select Contact Name</option>
                        @foreach ($leads as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($data) && $item->id == $data->lead_id ? 'selected' : '' }}>
                                {{ $item->contact_name }}
                            </option>
                        @endforeach
                    </select>
                    <input hidden name="step" value="1" />
                    <button type="submit"
                        class="text-white ms-5 max-w-fit bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Choose
                    </button>
                </div>
            </div>
        </div>
    </form>
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
            {{-- @dd($data['lead_id']) --}}

            <label for="lead_id">Lead reference:</label>
            <!-- <input type="search" id="search" name="search" value="{{ request('search') }}" placeholder="Contact Name" /> -->
            <select name="lead_id">
                <option value="" disabled selected>Contact Name</option>
                @foreach ($leads as $item)
                    <option value="{{ $item->id }}" {{ isset($data) && $item->id == $data->lead_id ? 'selected' : '' }}>
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
                <input type="text" name="lead_id" class="form-control" value="{{ isset($data) ? $data->lead_id : '' }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="contact_id">contact id:</label>
                <input type="text" name="contact_id" class="form-control"
                    value="{{ isset($data) ? $data->contact_id : '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="contact_name">Contact Name:</label>
                <input type="text" name="contact_name" class="form-control"
                    value="{{ isset($data) ? $data->contact_name : '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="company">Company:</label>
                <input type="text" name="company" class="form-control"
                    value="{{ isset($data) ? $data->company_name : '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control"
                    value="{{ isset($data) ? $data->contact_email : '' }}" readonly>
            </div>
            <div class="form-group">
                <label for="contact_address_id">Contact Address : </label>
                <select name="contact_address_id">
                    <option value="" disabled selected>Choose</option>
                    @if ($list_address && $list_address->isNotEmpty())
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
                <input type="text" name="contact_province" class="form-control"
                    value="{{ isset($data) ? $data->contact_province : '' }}" disbaled>
            </div>
            <div class="form-group">
                <label for="contact_city">city:</label>
                <input type="text" name="contact_city" class="form-control"
                    value="{{ isset($data) ? $data->contact_city : '' }}" disbaled>
            </div>

            <div class="form-group">
                <label for="contact_post_code">post code:</label>
                <input type="text" name="contact_post_code" class="form-control"
                    value="{{ isset($data) ? $data->contact_post_code : '' }}" disbaled>
            </div>
            <div class="form-group">
                <label for="contact_post_code">Quotation id:</label>
                <input type="text" name="id" class="form-control"
                    value="{{ isset($quotation) ? $quotation->id : '' }}" disbaled>
            </div>
            <br>
            <button type="submit" class="btn btn-success">next</button>
        </form>

        <!-- add New Address -->
        <form action="{{ route('quotations.addAddress') }}" method="POST">
            @csrf
            <h3>Add New Address</h3>
            <div class="form-group">
                <input type="text" name="contact_id" class="form-control"
                    value="{{ isset($data) ? $data->contact_id : '' }}" hidden>
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
                <input type="text" name="id" class="form-control"
                    value="{{ isset($quotation) ? $quotation->id : '' }}" disbaled>
            </div>
            <div class="form-group">
                <label for="category">Category : </label>
                <select name="category">
                    <option value="" disabled selected>Choose</option>
                    @foreach ($quotation_category as $item)
                        <option value="{{ $item }}"
                            {{ isset($quotation) && $item == $quotation->category ? 'selected' : '' }}>
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
                        <option value="{{ $item }}"
                            {{ isset($quotation) && $item == $quotation->source ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="closing_date_target">Closing Date Target:</label>
                <input type="date" name="closing_date_target" class="form-control"
                    value="{{ isset($quotation) ? $quotation->closing_date_target : '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" class="form-control">{{ isset($quotation) ? $quotation->description : '' }}</textarea>
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
                <input type="text" name="id" class="form-control"
                    value="{{ isset($quotation) ? $quotation->id : '' }}" disbaled>
            </div>
            <div class="form-group">
                <label for="franco">Franco :</label>
                <input type="text" name="franco" class="form-control"
                    value="{{ isset($quotation) ? $quotation->franco : '' }}">
            </div>

            <div class="form-group">
                <label for="validity">Validity :</label>
                <input type="text" name="validity" class="form-control"
                    value="{{ isset($quotation) ? $quotation->validity : '' }}">
            </div>

            <div class="form-group">
                <label for="delivery_estimation">Delivery Estimation :</label>
                <input type="date" name="delivery_estimation" class="form-control"
                    value="{{ isset($quotation) ? $quotation->validity : '' }}">
            </div>

            <div class="form-group">
                <label for="delivery_condition">Delivery Conditon : </label>
                <select name="delivery_condition">
                    <option value="" disabled selected>Choose</option>
                    @foreach ($dev_con as $item)
                        <option value="{{ $item }}"
                            {{ isset($quotation) && $item == $quotation->delivery_condition ? 'selected' : '' }}>
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
                        <option value="{{ $item }}"
                            {{ isset($quotation) && $item == $quotation->term_of_payment ? 'selected' : '' }}>
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
                <input type="text" name="id" class="form-control"
                    value="{{ isset($quotation) ? $quotation->id : '' }}" disbaled>
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

            @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
                <!-- Check if the user is admin -->
                <div class="form-group">
                    <label for="sales_id">Sales:</label>
                    <select class="form-control" id="sales_id" name="sales_id">
                        <option value="" disabled selected>Choose </option>
                        @foreach ($user as $item)
                            <option value="{{ $item->id }}"
                                {{ isset($quotation) && $item->id == $quotation->sales_id ? 'selected' : '' }}>
                                {{ $item->fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="form-group">
                    <label for="sales_id">Sales:</label>
                    <input type="text" name="sales_id" class="form-control" value="{{ $user->fullname }}">
                </div>
            @endif

            <button type="submit" class="btn btn-success">Create Quotation</button>

        </form>


    </div>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const currentStep = urlParams.get('step');
        const steps = document.querySelectorAll('.step');
        steps.forEach((step, index) => {
            if (index == +currentStep - 1) {
                steps[index].classList.remove('text-gray-500', 'dark:text-gray-400', "border-gray-400");
                steps[index].classList.add('text-blue-600', 'dark:text-blue-500', "border-blue-600");
            } else {
                steps[index].classList.remove('text-blue-600', 'dark:text-blue-500', "border-blue-600");
                steps[index].classList.add('text-gray-500', 'dark:text-gray-400', "border-gray-400");
            }
        })
    </script>

@endsection
