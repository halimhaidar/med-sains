@extends('layouts.dashboard')

@section('content')
    <div
        class="w-full text-gray-500 bg-white border border-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">
        @if (session('success'))
            <div id="successMessage"
                class="bg-green-400 border border-green-400 text-black dark:text-white px-4 py-3 rounded-lg mb-5"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div id="errorMessage" class="top-4 right-4 mb-5 mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
    <div class="form-steps" style="display: none;">
        <div class="flex items-center">
            <form class="p-10" method="GET" action="{{ route('quotations.create') }}">
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
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="me-10 block max-h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Add New Address
            </button>
        </div>
        <form class="p-10" action="{{ route('quotations.nextStep') }}" method="POST">
            @csrf
            <input type="text" name="type" value="contact_info" style="display: none;" />
            <input type="text" name="id" value="" style="display: none;" id="contact_info_quotation" />
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <div class="col-span-2">
                    <label for="lead_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lead
                        ID
                    </label>
                    <input type="text" name="lead_id" id="lead_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->lead_id : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="contact_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        ID
                    </label>
                    <input type="text" name="contact_id" id="contact_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_id : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="contact_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Name
                    </label>
                    <input type="text" name="contact_name" id="contact_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_name : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company

                    </label>
                    <input type="text" name="company" id="company"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->company_name : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email

                    </label>
                    <input type="text" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_email : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="contact_address_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Address
                    </label>
                    <select id="contact_address_id" name="contact_address_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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
                <div class="col-span-2">
                    <label for="contact_province"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province
                    </label>
                    <input type="text" name="contact_province" id="contact_province"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_province : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="contact_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City

                    </label>
                    <input type="text" name="contact_city" id="contact_city"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_city : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="contact_post_code"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Code
                    </label>
                    <input type="text" name="contact_post_code" id="contact_post_code" pattern="[0-9]+"
                        title="Only numbers are allowed"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($data) ? $data->contact_post_code : '' }}" readonly />
                </div>
            </div>
            <div class="flex w-full justify-end">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                    Next: General Data
                </button>
            </div>
        </form>
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 bottom-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Add New Address
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('quotations.addAddress') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-4">
                            <input type="text" name="contact_id" class="form-control"
                                value="{{ isset($data) ? $data->contact_id : '' }}" hidden>
                            <div class="col-span-2 ">
                                <label for="province"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">province</label>
                                <input type="text" name="province" id="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                <input type="text" name="city" id="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="post_code"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Code</label>
                                <input type="text" name="post_code" id="post_code" pattern="[0-9]+"
                                    title="Only numbers are allowed"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                <textarea id="address" name="address" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>
                        </div>
                        <div class="w-full flex justify-end"> <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add New Address
                            </button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="form-steps">
        <form class="p-10" action="{{ route('quotations.nextStep') }}" method="POST">
            @csrf
            <input type="text" name="type" value="general_data" style="display: none;" />
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <div class="col-span-2">
                    <label for="quotation_ids"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quotation ID
                    </label>
                    <input type="text" name="id" id="quotation_ids"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->id : '' }}" readonly />
                </div>
                <div class="col-span-2">
                    <label for="category_quotation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                    </label>
                    <select id="category_quotation" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Choose</option>
                        @foreach ($quotation_category as $item)
                            <option value="{{ $item }}"
                                {{ isset($quotation) && $item == $quotation->category ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sources
                    </label>
                    <select id="source" name="source"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Choose</option>
                        @foreach ($quotation_source as $item)
                            <option value="{{ $item }}"
                                {{ isset($quotation) && $item == $quotation->source ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="closing_date_target"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Closing Date Target
                    </label>
                    <input type="date" name="closing_date_target" id="closing_date_target"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->closing_date_target : '' }}" />
                </div>
                <div class="col-span-2">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ isset($quotation) ? $quotation->description : '' }}</textarea>
                </div>
            </div>
            <div class="flex w-full justify-between">
                <button type="button" onclick="updateStepQueryParam(1)"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Previous: Contact Info
                </button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                    Next: Offer Condition
                </button>
            </div>
        </form>
    </div>
    <div class="form-steps">
        <form class="p-10" action="{{ route('quotations.nextStep') }}" method="POST">
            @csrf
            <input type="text" name="type" value="offer_condition" style="display: none;" />
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <div class="col-span-2">
                    <label for="quotation_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quotation ID
                    </label>
                    <input type="text" name="id" id="quotation_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->id : '' }}" readonly>
                </div>
                <div class="col-span-2">
                    <label for="franco" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Franco
                    </label>
                    <input type="text" name="franco" id="franco"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->franco : '' }}">
                </div>
                <div class="col-span-2">
                    <label for="validity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Validity
                    </label>
                    <input type="text" pattern="[0-9]+" title="Masukan Dengan Format Yang Sesuai" name="validity"
                        id="validity"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->validity : '' }}">
                </div>
                <div class="col-span-2">
                    <label for="delivery_estimation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivery Estimation
                    </label>
                    <input type="date" name="delivery_estimation" id="delivery_estimation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->delivery_estimation : '' }}">
                </div>
                <div class="col-span-2">
                    <label for="delivery_condition"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivery Condition
                    </label>
                    <select id="delivery_condition" name="delivery_condition"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Choose</option>
                        @foreach ($dev_con as $item)
                            <option value="{{ $item }}"
                                {{ isset($quotation) && $item == $quotation->delivery_condition ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="term_of_payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term
                        of Payment
                    </label>
                    <select id="term_of_payment" name="term_of_payment"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Choose</option>
                        @foreach ($top as $item)
                            <option value="{{ $item }}"
                                {{ isset($quotation) && $item == $quotation->term_of_payment ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex w-full justify-between">
                <button type="button" onclick="updateStepQueryParam(2)"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Previous: General Data
                </button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                    Next: Product Item
                </button>
            </div>
        </form>
    </div>
    <div class="form-steps">
        <form class="p-10" action="{{ route('quotations.nextStep') }}" method="POST">
            @csrf
            <input type="text" name="type" value="product_item" style="display: none;" />
            <div class="flex justify-between">
                <div>
                    <label for="quotation_ids"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quotation ID
                    </label>
                    <input type="text" name="id" id="quotation_ids"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($quotation) ? $quotation->id : '' }}" readonly />
                </div>
                <div>
                    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                        List
                    </label>
                    <select id="product_id" name="product_id" onchange="onChangeProduct()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Choose</option>
                        @foreach ($listProducts as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- table -->
            <div class=" overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product | Brand
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sorting
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                    </tbody>
                </table>
            </div>
            <div class="flex w-full justify-between pt-10">
                <button type="button" onclick="updateStepQueryParam(3)"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Previous: Offer Condition
                </button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                    Create Quotation
                </button>
            </div>
        </form>
    </div>

    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function updateStepQueryParam(step) {
            const url = new URL(window.location.href);
            url.searchParams.set('step', step);
            window.location.href = url.toString();
        }

        const currentStep = getQueryParam('step');
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
        const setQuotationId = document.getElementById("contact_info_quotation");
        if (getQueryParam("quotationId")) {
            setQuotationId.value = getQueryParam("quotationId")
        }
        // form steps
        const forms = document.querySelectorAll('.form-steps');
        const formArray = Array.from(forms);
        formArray.forEach((form, index) => {
            // Show the form that matches the 'step' parameter (considering 1-based index)
            if (index + 1 == currentStep) {
                form.style.display = 'block'; // Show this form
            } else {
                form.style.display = 'none'; // Hide others
            }
        });

        const listAddress = @json($list_address);
        const selectedAddress = document.getElementById('contact_address_id');
        const contact_province = document.getElementById('contact_province');
        const contact_city = document.getElementById('contact_city');
        const contact_post_code = document.getElementById('contact_post_code');
        selectedAddress.addEventListener('change', function() {
            const selectedId = parseInt(selectedAddress.value);
            const selectedObj = listAddress.find(address => address.id === selectedId);

            if (selectedObj) {
                contact_province.value = selectedObj.province;
                contact_city.value = selectedObj.city;
                contact_post_code.value = selectedObj.post_code;
            }
        });

        const jsonListProducts = @json($listProducts);
        let dataProductPhp = jsonListProducts;

        let listProducts = [];

        const jsonSelectedProduct = @json($selected_product);
        if (jsonSelectedProduct.length) {
            listProducts = [...jsonSelectedProduct]
        }

        function onChangeProduct(e) {
            const selectElement = document.getElementById('product_id');
            const selectedValue = selectElement.value;
            let [filteredProducts] = filterById(dataProductPhp, selectedValue);
            if (listProducts.find((e) => e.id == selectedValue)) {
                return;
            }
            listProducts.push(filteredProducts)
            populateTable(listProducts)
        }

        const tableBody = document.getElementById('productTableBody');

        function populateTable(data) {
            // Clear the existing rows first to avoid duplication
            tableBody.innerHTML = '';
            data.forEach((product, index) => {
                // Create a new row
                const row = document.createElement('tr');
                row.classList.add('border-b', 'border-gray-300', 'dark:border-gray-600', 'hover:bg-gray-100',
                    'dark:hover:bg-gray-700');

                // Insert columns with product data
                row.innerHTML = `
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input style="display: none;" type="text" name="products[${index}][product_id]" value="${product.id}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" readonly />${product.id}</td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200">${product.name} | ${product.brand_name}</td></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" pattern="[0-9]+"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][sorting]" value="${product.sorting ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" pattern="[0-9]+"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][quantity]" value="${product.quantity ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" id="discount-${index}"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][discount]" value="${product.discount ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" pattern="[0-9]+"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][price_offer]" value="${product.price_offer ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><button type="button" onclick="handleDeleteProduct(${product.id})" class="text-red-500">delete</button></td>
                `;

                // Append the new row to the table body
                tableBody.appendChild(row);
                document.getElementById(`discount-${index}`).setAttribute("pattern", "^\\d+(\\.\\d{1,2})?$");
            });
        }

        listProducts && populateTable(listProducts);

        function filterById(products, id) {
            return products.filter(product => product.id == id);
        }

        function handleDeleteProduct(id) {
            const newList = listProducts.filter(product => product.id != id)
            listProducts = [...newList];
            populateTable(listProducts)
        }
    </script>

@endsection
