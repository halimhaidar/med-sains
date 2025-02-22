@extends('layouts.dashboard')

@section('content')
    @if (session('success'))
        <div id="successMessage"
            class="bg-green-400 border border-green-400 text-black dark:text-white px-4 py-3 rounded-lg mb-5" role="alert">
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

    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md w-full mx-auto">
        <!-- Header Section -->
        <div class="flex items-start justify-between">
            <div class="flex">
                <!-- Adjust this section -->
                <div
                    class="bg-pink-200 text-pink-600 font-semibold text-lg px-4 py-2 rounded-md flex items-center justify-center">
                    {{ $data->id }}
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $data->company_name }}
                    </h2>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 mt-2">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>{{ $data->contact_email }}</span>
                    </div>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-phone mr-2"></i>
                        <span>{{ $data->contact_phone }}</span>
                    </div>
                </div>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Assign To</button>
        </div>

        <!-- Lead Reference and Dates -->
        <div class="grid grid-cols-4 gap-4 mt-4">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Lead Ref</p>
                <p class="font-medium text-blue-600 dark:text-blue-400">{{ $data->lead_id }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Start Date</p>
                <p class="font-medium text-gray-800 dark:text-gray-100">
                    {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Close Date Target</p>
                <p class="font-medium text-orange-600">
                    {{ \Carbon\Carbon::parse($data->closing_date_target)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Note Section -->
        <p class="mt-4 text-sm text-gray-800 dark:text-gray-100">
            {{ $data->description }}
        </p>

        <!-- Footer Section -->
        <div class="mt-6 grid grid-cols-6 gap-4 border-t pt-4 border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <i class="fas fa-user text-gray-500 dark:text-gray-400 mr-6"></i>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800 dark:text-gray-100">Handle By</p>
                    <p class="font-medium text-gray-800 dark:text-gray-100">{{ $data->contact_name }}</p>
                </div>
            </div>
            {{-- <div class="flex items-center">
                <i class="fas fa-building text-gray-500 dark:text-gray-400 mr-2"></i>
                <p class="font-medium text-gray-800 dark:text-gray-100">National Sales Department - Academic & Reseller</p>
            </div> --}}
            {{-- <div class="flex items-center">
                <i class="fas fa-tasks text-gray-500 dark:text-gray-400 mr-2"></i>
                <p class="font-medium text-red-500">High</p>
            </div> --}}
            <div class="flex items-center">
                <i class="fas fa-comment-dots text-gray-500 dark:text-gray-400 mr-6"></i>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800 dark:text-gray-100">Source</p>
                    <p class="font-medium text-gray-800 dark:text-gray-100">{{ $data->source }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <i class="fas fa-clipboard-list text-gray-500 dark:text-gray-400 mr-6"></i>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800 dark:text-gray-100">Category</p>
                    <p class="font-medium text-gray-800 dark:text-gray-100">{{ $data->category }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <i class="fas fa-clipboard-check text-gray-500 dark:text-gray-400 mr-6"></i>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800 dark:text-gray-100">Status</p>
                    <p class="font-medium text-blue-500">Quotation</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Sections --}}
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="overview-tab" data-tabs-target="#overview"
                    type="button" role="tab" aria-controls="overview" aria-selected="false">Overview</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="edit-tab" data-tabs-target="#edit" type="button" role="tab" aria-controls="edit"
                    aria-selected="false">Edit</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                    aria-selected="false">Settings</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts"
                    aria-selected="false">Contacts</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overview" role="tabpanel"
            aria-labelledby="overview-tab">
            <div id="pdf-content" style="margin: 20px; background-color: white;" class="text-xs">
                <div class="mx-auto bg-white shadow-md border-2 border-black p-4">
                    <!-- Header Section -->
                    <div class="border-b pb-6 mb-6">
                        <div class="flex justify-between items-center">
                            <!-- Company Info -->
                            <div>
                                <img src="{{ asset('image/logo/medisains.svg') }}" class="h-16" alt="Medisains Logo" />
                            </div>
                            <div>
                                <h1 class="text-sm font-bold text-gray-800">Medsains</h1>
                                <p class="font-semibold text-gray-700">PT Bioteknologi Sinergi Mandiri</p>
                                <div class="text-gray-600">
                                    <p>Ruko Pesona View, Blok B No.4</p>
                                    <p>Jl. Ir. H. Juanda, Sukma Jaya,</p>
                                    <p>Depok, 16411</p>
                                    <p>Telepon : 021-77846655</p>
                                    <p>Email : info@advisains.id</p>
                                    <p>Website : www.advisains.id</p>
                                </div>
                            </div>

                            <!-- Quotation Number -->
                            <div class="text-right">
                                <h2 class="text-sm font-bold text-gray-800">QUOTATION</h2>
                                <p class="text-gray-600">{{ $data->id }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-2 text-xs">
                        <div>
                            <!-- Left Column -->
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Date</span>
                                <span class="text-gray-800">:
                                    {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Company</span>
                                <span class="text-gray-800">: {{ $data->company_name }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Contact</span>
                                <span class="text-gray-800">: {{ $data->contact_name }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Bill to</span>
                                <span class="text-gray-800">: {{ $data->contact_name }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Address</span>
                                <span class="text-gray-800">: {{ $data->contact_address }}</span>
                            </div>
                        </div>

                        <div>
                            <!-- Right Column -->
                            <div class="grid grid-cols-[6rem_1fr] row-span-2 items-start">
                                <span class="text-gray-600">Delivery to</span>
                                <span class="text-gray-800">: {{ $data->contact_name }} </span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Kurs</span>
                                <span class="text-gray-800">: IDR</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Term</span>
                                <span class="text-gray-800">: {{ $data->term_of_payment }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $totalPrice = 0;
                @endphp
                <div class="grid grid-cols-7 gap-4 p-2">
                    <div class="whitespace-nowrap">No.</div>
                    <div class="whitespace-nowrap">Product name</div>
                    <div class="whitespace-nowrap">Brand name</div>
                    <div class="whitespace-nowrap">Quantity</div>
                    <div class="whitespace-nowrap">Price</div>
                    <div class="whitespace-nowrap">Discount</div>
                    <div class="whitespace-nowrap">Total Price</div>
                    @foreach ($selected_product as $index => $product)
                        <div class="whitespace-nowrap">{{ $index + 1 }}.</div>
                        <div class="whitespace-nowrap">{{ $product->name }}</div>
                        <div class="whitespace-nowrap">{{ $product->brand_name }}</div>
                        <div class="whitespace-nowrap">{{ $product->quantity }}</div>
                        <div class="whitespace-nowrap">Rp. {{ number_format($product->price_offer, 0, ',', '.') }}</div>
                        <div class="whitespace-nowrap">{{ $product->discount }} %</div>
                        @php
                            $productPrice = $product->price_offer;
                            $quantity = $product->quantity;
                            $discountPercentage = $product->discount / 100;

                            $finalPrice = $productPrice * $quantity * (1 - $discountPercentage);
                            $totalPrice = $totalPrice + $finalPrice;
                        @endphp
                        <div class="whitespace-nowrap">Rp. {{ number_format($finalPrice, 0, ',', '.') }}</div>
                    @endforeach
                </div>
                <div class="border-2 border-black min-h-16 mt-20 text-xs p-2">
                    <div class="text-xs m-0 p-0 h-fit">
                        <span class="text-gray-600">Offer Conditions :</span>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr]">
                        <div>
                            <!-- Left Column -->
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Descriptions</span>
                                <span class="text-gray-800">: {{ $data->description }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Installation Cost</span>
                                <span class="text-gray-800">: ?????</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Franco</span>
                                <span class="text-gray-800">: {{ $data->franco }}</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Validity</span>
                                <span class="text-gray-800">: {{ $data->validity }} Days</span>
                            </div>
                            <div class="grid grid-cols-[6rem_1fr] items-start">
                                <span class="text-gray-600">Delivery</span>
                                <span class="text-gray-800">: {{ $data->delivery_estimation }}</span>
                            </div>
                        </div>

                        <div>
                            <!-- Right Column -->
                            <div class="grid grid-cols-[6rem_1fr] row-span-2 items-start">
                                <span class="text-gray-600">Grand Total</span>
                                <span class="text-gray-800">: Rp. {{ number_format($totalPrice, 0, ',', '.') }} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-lg p-4">MediSains</div>
                <div class="text-sm p-4">Signature ????</div>
                <div class="grid grid-rows-2 items-start p-4">
                    <span class="text-sm text-gray-800">Ini Siapa ?</span>
                    <span class="text-sm text-gray-800">Ini Nomor Siapa ?</span>
                </div>

            </div>
            <button id="generate-pdf" onclick="downloadPDF()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">Generate
                PDF</button>
            <button onclick="previewPDF()"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">Preview
                PDF</button>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="edit" role="tabpanel"
            aria-labelledby="edit-tab">
            {{-- Tabs Edit Section --}}
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                    data-tabs-toggle="#default-styled-tab-content"
                    data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="general-styled-tab"
                            data-tabs-target="#styled-general" type="button" role="tab" aria-controls="general"
                            aria-selected="false">General</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="offerconditions-styled-tab" data-tabs-target="#styled-offerconditions" type="button"
                            role="tab" aria-controls="offerconditions" aria-selected="false">Offer
                            Conditions</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="address-styled-tab" data-tabs-target="#styled-address" type="button" role="tab"
                            aria-controls="address" aria-selected="false">Address</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="pdfsetting-styled-tab" data-tabs-target="#styled-pdfsetting" type="button"
                            role="tab" aria-controls="pdfsetting" aria-selected="false">PDF Setting</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="products-styled-tab" data-tabs-target="#styled-products" type="button" role="tab"
                            aria-controls="products" aria-selected="false">Products</button>
                    </li>
                </ul>
            </div>
            <div id="default-styled-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-general" role="tabpanel"
                    aria-labelledby="general-tab">
                    <div class="form-steps">
                        <form class="p-10" action="{{ route('quotations.nextStepDetail', $data->id) }}"
                            method="POST">
                            @csrf
                            <input type="text" name="type" value="general_data" style="display: none;" />
                            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                <div class="col-span-2">
                                    <label for="quotation_ids"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quotation
                                        ID
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
                                    <label for="source"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sources
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
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Closing
                                        Date
                                        Target
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
                            <div class="flex w-full justify-end">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                                    Edit General Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-offerconditions"
                    role="tabpanel" aria-labelledby="offerconditions-tab">
                    <form class="p-10" action="{{ route('quotations.nextStepDetail', $data->id) }}" method="POST">
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
                                <label for="franco"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Franco
                                </label>
                                <input type="text" name="franco" id="franco"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->franco : '' }}">
                            </div>
                            <div class="col-span-2">
                                <label for="validity"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Validity
                                </label>
                                <input type="text" pattern="[0-9]+" title="Masukan Dengan Format Yang Sesuai"
                                    name="validity" id="validity"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->validity : '' }}">
                            </div>
                            <div class="col-span-2">
                                <label for="delivery_estimation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivery
                                    Estimation
                                </label>
                                <input type="date" name="delivery_estimation" id="delivery_estimation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->delivery_estimation : '' }}">
                            </div>
                            <div class="col-span-2">
                                <label for="delivery_condition"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivery
                                    Condition
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
                                <label for="term_of_payment"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term
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
                        <div class="flex w-full justify-end">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                                Edit Offer Conditions
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-address" role="tabpanel"
                    aria-labelledby="address-tab">
                    <div class="flex justify-end">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="me-10 block max-h-fit text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            type="button">
                            Add New Address
                        </button>
                    </div>
                    <div id="crud-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 bottom-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Add New Address
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="crud-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
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
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                                                Code</label>
                                            <input type="text" name="post_code" id="post_code"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="col-span-2 ">
                                            <label for="phone"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                            <input type="text" name="phone" id="phone" pattern="[0-9]+"
                                                title="Only numbers are allowed"
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
                                    <div class="w-full flex justify-end">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Add New Address
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form class="p-10" action="{{ route('quotations.nextStepDetail') }}" method="POST">
                        @csrf
                        <input type="text" name="type" value="contact_info" style="display: none;" />
                        <input type="text" name="id" value="{{ isset($quotation) ? $quotation->id : '' }}"
                            style="display: none;" />
                        <input type="text" name="contact_id" value="{{ isset($data) ? $data->contact_id : '' }}"
                            style="display: none;" />
                        <input type="text" name="lead_id" class="form-control"
                            value="{{ isset($data) ? $data->lead_id : '' }}" style="display: none;">
                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
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
                                            <option value="{{ $item->id }}"
                                                {{ $item->default == 1 ? 'selected' : '' }}>
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
                                <label for="contact_city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City

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
                                Edit Address
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-pdfsetting" role="tabpanel"
                    aria-labelledby="pdfsetting-tab">
                    <form action="{{ route('quotations.nextStepDetail') }}" method="POST">
                        @csrf
                        <input type="text" name="type" class="form-control" value="pdf_setting" readonly hidden>
                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
                            <input type="text" name="id" id="contact_post_code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="{{ isset($quotation) ? $quotation->id : '' }}" readonly style="display: none;" />

                            <div class="col-span-2">
                                <label for="pdf_show"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Show Total
                                </label>
                                <input type="text" name="pdf_show" id="pdf_show"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->pdf_show : '' }}" />
                            </div>
                            <div class="col-span-2">
                                <label for="pdf_show_decimal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Show Decimal
                                </label>
                                <input type="text" name="pdf_show_decimal" id="pdf_show_decimal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->pdf_show_decimal : '' }}" />
                            </div>
                            <div class="col-span-2">
                                <label for="margin_1"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Margin 1
                                </label>
                                <input type="text" name="margin_1" id="margin_1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->margin_1 : '' }}" />
                            </div>
                            <div class="col-span-2">
                                <label for="margin_2"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Margin 2
                                </label>
                                <input type="text" name="margin_2" id="margin_2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($quotation) ? $quotation->margin_2 : '' }}" />
                            </div>
                        </div>
                        <div class="flex w-full justify-end">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-products" role="tabpanel"
                    aria-labelledby="products-tab">
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
                                <label for="product_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
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
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                        <div class="flex w-full justify-end pt-10">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
            aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
            aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                control
                the content visibility and styling.</p>
        </div>
    </div>




    {{-- <div class="container">


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
<form action="{{ route('quotations.nextStepDetail') }}" method="POST">
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
<form action="{{ route('quotations.nextStepDetail') }}" method="POST">
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
    <button type="submit" class="btn btn-success">save</button>

</form>


<!-- section Offer Condition -->
<form action="{{ route('quotations.nextStepDetail') }}" method="POST">
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
        <label for="delivery_conditon">Delivery Conditon : </label>
        <select name="delivery_conditon">
            <option value="" disabled selected>Choose</option>
            @foreach ($dev_con as $item)
            <option value="{{ $item }}" {{ (isset($quotation) && $item == $quotation->delivery_conditon) ? 'selected' : '' }}>
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
    <button type="submit" class="btn btn-success">save</button>
</form>

<!-- section Product Item -->
<form action="{{ route('quotations.nextStepDetail') }}" method="POST">
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

    @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
    <!-- Check if the user is admin -->
    <div class="form-group">
        <label for="sales_id">Sales:</label>
        <select class="form-control" id="sales_id" name="sales_id">
            <option value="" disabled selected>Choose </option>
            @foreach ($user as $item)

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

    <button type="submit" class="btn btn-success">save</button>

</form>

<!-- section PDF Setting -->
<form action="{{ route('quotations.nextStepDetail') }}" method="POST">
    @csrf
    <h3>5. PDF Setting</h3>
    <div class="form-group">
        <label for="type">type:</label>
        <input type="text" name="type" class="form-control" value="pdf_setting" readonly>
    </div>
    <div class="form-group">
        <label for="contact_post_code">Quotation id:</label>
        <input type="text" name="id" class="form-control" value="{{ isset($quotation)?$quotation->id:''}}" disbaled>
    </div>
    <div class="form-group">
        <label for="pdf_show">Show Total:</label>
        <input type="text" name="pdf_show" class="form-control" value="{{ isset($quotation)?$quotation->pdf_show:''}}">
    </div>
    <div class="form-group">
        <label for="pdf_show_decimal">Show Decimal:</label>
        <input type="text" name="pdf_show_decimal" class="form-control" value="{{ isset($quotation)?$quotation->pdf_show_decimal:''}}">
    </div>
    <div class="form-group">
        <label for="margin_1">Margin 1:</label>
        <input type="text" name="margin_1" class="form-control" value="{{ isset($quotation)?$quotation->margin_1:''}}">
    </div>
    <div class="form-group">
        <label for="margin_2">Margin 2:</label>
        <input type="text" name="margin_2" class="form-control" value="{{ isset($quotation)?$quotation->margin_2:''}}">
    </div>


    <button type="submit" class="btn btn-success">save</button>

</form>


</div> --}}

    <script>
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
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" pattern="[0-9]+"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][discount]" value="${product.discount ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><input type="text" pattern="[0-9]+"
                                    title="Masukan Dengan Format Yang Sesuai" name="products[${index}][price_offer]" value="${product.price_offer ?? 0}" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200" /></td>
                    <td class="px-6 py-2 text-gray-900 dark:text-gray-200"><button type="button" onclick="handleDeleteProduct(${product.id})" class="text-red-500">delete</button></td>
                `;

                // Append the new row to the table body
                tableBody.appendChild(row);
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

        // document.getElementById('generate-pdf').addEventListener('click', function() {
        //     var element = document.getElementById('pdf-content');
        //     {

        //         var opt = {
        //             filename: 'my-pdf-fileee.pdf',
        //             jsPDF: {
        //                 unit: 'in',
        //                 format: 'letter',
        //                 orientation: 'portrait'
        //             }
        //         };

        //     }

        //     html2pdf()
        //         .set(opt)
        //         .from(element)
        //         .save();
        // });
        function downloadPDF() {
            const content = document.getElementById('pdf-content');

            html2pdf().from(content).set({
                margin: [10, 10, 10, 10], // Add slight margin
                filename: 'document.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1.0
                },
                html2canvas: {
                    scale: 1, // Set scale to 1 to match display size exactly
                    useCORS: true
                },
                jsPDF: {
                    unit: 'pt',
                    format: 'a4', // Default format; let html2pdf auto-calculate height
                    orientation: 'portrait'
                }
            }).save();
        }

        function previewPDF() {
            const content = document.getElementById('pdf-content');

            html2pdf().from(content).set({
                margin: [10, 10, 10, 10], // Add slight margin
                filename: 'document.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1.0
                },
                html2canvas: {
                    scale: 1, // Set scale to 1 to match display size exactly
                    useCORS: true
                },
                jsPDF: {
                    unit: 'pt',
                    format: 'a4', // Default format; let html2pdf auto-calculate height
                    orientation: 'portrait'
                }
            }).toPdf().outputPdf('blob').then((pdfBlob) => {
                // Create a URL for the PDF blob and open it in a new tab
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank'); // Opens the PDF preview in a new tab
            });
        }
    </script>
@endsection
