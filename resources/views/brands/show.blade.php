@extends('layouts.dashboard')

@section('content')
    <p class="text-xl font-semibold text-gray-900 dark:text-white mb-8">Detail Brands</p>
    @if ($errors->any())
        <div id="errorMessage" class="top-4 right-4 mb-5 mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="p-4 flex items-center justify-between bg-white dark:bg-gray-800 shadow-md">
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Year</label>
            <select id="year"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option>2024</option>
                <!-- Add more options here -->
            </select>
        </div>
        <button
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Filter
        </button>
    </div>

    <!-- Tabs Section -->
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
                    id="product-tab" data-tabs-target="#product" type="button" role="tab" aria-controls="product"
                    aria-selected="false">Product</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500"
                    id="history-tab" data-tabs-target="#history" type="button" role="tab" aria-controls="history"
                    aria-selected="false" disabled>History Report</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500"
                    id="sales-tab" data-tabs-target="#sales" type="button" role="tab" aria-controls="sales"
                    aria-selected="false" disabled>Sales Report</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overview" role="tabpanel"
            aria-labelledby="overview-tab">
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                @php
                    $sq_target = $brand->sq_target;
                    $sq_current = 562061; // Replace with actual sq_current value
                    $sq_percentage = $sq_target > 0 ? ($sq_current / $sq_target) * 100 : 0;
                    $sq_limitedPercentage = min($sq_percentage, 100);

                    $so_target = $brand->so_target;
                    $so_current = 562061; // Replace with actual sq_current value
                    $so_percentage = $so_target > 0 ? ($so_current / $so_target) * 100 : 0;
                    $so_limitedPercentage = min($so_percentage, 100);

                @endphp
                <!-- Brand, Product Specialist, Priority, Group Info -->
                <div class="col-span-1 md:col-span-3 bg-white dark:bg-gray-800 p-4 rounded-md shadow">
                    <div class="flex justify-around">
                        <div class="flex gap-5">
                            @if ($brand->image_brand)
                                <img src="{{ $brand->image_brand }}" alt="{{ $brand->name }}" width="100"
                                    class="mb-2">
                            @endif
                            <div class="text-center">
                                <p class="font-medium text-gray-700 dark:text-gray-300">{{ $brand->name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Brand Name</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="font-medium text-gray-700 dark:text-gray-300">{{ $brand->handle_by }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Handle By</p>
                        </div>
                        <div class="text-center">
                            <p class="font-medium text-gray-700 dark:text-gray-300">{{ $brand->category_name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                        </div>
                    </div>
                </div>
                <!-- Cards -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-blue-500 font-medium">Quotation Target</p>
                    <p class="text-gray-500 dark:text-gray-400">
                        Rp. {{ number_format($brand->sq_target, 0, ',', '.') ?? 'Please set target !!' }}</p>
                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width: {{ $sq_limitedPercentage }}%">{{ round($sq_percentage) }}%</div>
                    </div>
                </div>

                <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-blue-500 font-medium">1</p>
                    <p class="text-gray-500 dark:text-gray-400">Total Quotation</p>
                    <p class="text-blue-500 font-medium">Rp. 562.061</p>
                </div>
                <div class="bg-orange-100 dark:bg-orange-900 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-orange-500 font-medium">1</p>
                    <p class="text-gray-500 dark:text-gray-400">Total Product</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-blue-500 font-medium">Order Target</p>
                    <p class="text-gray-500 dark:text-gray-400">Rp.
                        {{ number_format($brand->so_target, 0, ',', '.') ?? 'Please set target !!' }}</p>
                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width: {{ $so_limitedPercentage }}%">{{ round($so_percentage) }}%</div>
                    </div>>
                </div>

                <div class="bg-green-100 dark:bg-green-900 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-green-500 font-medium">1</p>
                    <p class="text-gray-500 dark:text-gray-400">Total Sales Order</p>
                    <p class="text-green-500 font-medium">Rp. 562.061</p>
                </div>

                <div class="bg-red-100 dark:bg-red-900 p-4 rounded-md shadow flex flex-col justify-between">
                    <p class="text-red-500 font-medium">1</p>
                    <p class="text-gray-500 dark:text-gray-400">Outstanding Sales Order</p>
                    <p class="text-red-500 font-medium">Rp. 562.061</p>
                </div>

            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="edit" role="tabpanel"
            aria-labelledby="edit-tab">
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
                            id="target-styled-tab" data-tabs-target="#styled-target" type="button" role="tab"
                            aria-controls="target" aria-selected="false">Target</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="category-styled-tab" data-tabs-target="#styled-category" type="button" role="tab"
                            aria-controls="category" aria-selected="false">Principal Category</button>
                    </li>
                </ul>
            </div>
            <div id="default-styled-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-general" role="tabpanel"
                    aria-labelledby="general-tab">
                    <form class="p-4 md:p-5" action="{{ route('brands.update', $brand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-4">
                            <div class="col-span-2 ">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand Name</label>
                                <input type="text" name="name" id="name" value="{{ $brand->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="handle_by"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Handle By</label>
                                <input type="text" name="handle_by" id="handle_by" value="{{ $brand->handle_by }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="category_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category_id" name="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->name == $brand->category_name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 ">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="image_brand">Upload file</label>
                                @if ($brand->image_brand)
                                    <img src="{{ $brand->image_brand }}" alt="{{ $brand->name }}" width="100"
                                        class="mb-2">
                                @endif
                                <input type="file"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="image_brand_help" id="image_brand" name="image_brand">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_brand_help"> PNG, JPG,
                                    JPEG
                                    or
                                    GIF (MAX. 2MB).</p>
                            </div>
                            <div class="col-span-2 ">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" name="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $brand->description }}</textarea>
                            </div>
                        </div>
                        <div class="w-full flex justify-end"> <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Update brands
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-target" role="tabpanel"
                    aria-labelledby="target-tab">
                    <form class="p-4 md:p-5" action="{{ route('brands.update-target', $brand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-4">
                            <div class="col-span-2 ">
                                <label for="sq_target"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quotation
                                    Target</label>
                                <input type="text" name="sq_target" id="sq_target" value="{{ $brand->sq_target }}" pattern="\d+" title="Masukan Dengan Format Yang Sesuai"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="so_target"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order
                                    Target</label>
                                <input type="text" name="so_target" id="so_target" value="{{ $brand->so_target }}" pattern="\d+" title="Masukan Dengan Format Yang Sesuai"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-2 ">
                                <label for="sales_target"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sales
                                    Target</label>
                                <input type="text" name="sales_target" id="sales_target" pattern="\d+" title="Masukan Dengan Format Yang Sesuai"
                                    value="{{ $brand->sales_target }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                        </div>
                        <div class="w-full flex justify-end"> <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Update Target
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-category" role="tabpanel"
                    aria-labelledby="category-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                            class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                        Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                        classes to control the content visibility and styling.</p>
                </div>
            </div>

        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="product" role="tabpanel"
            aria-labelledby="product-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="history" role="tabpanel"
            aria-labelledby="history-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sales" role="tabpanel"
            aria-labelledby="sales-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
    </div>
@endsection
