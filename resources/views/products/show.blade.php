@extends('layouts.dashboard')

@section('content')
    <p class="text-xl font-semibold text-gray-900 dark:text-white mb-8">Detail Product</p>
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



    {{-- Tabs Section --}}
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
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md space-y-6">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->created_at }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Last Update Price</p>
                    </div>
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->stock ?: '-' }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Stock</p>
                    </div>
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->safety_stock ?: '-' }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Safety Stock</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 text-center">
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">Rp.
                            {{ number_format($product->price, 2) }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Note: Harga bisa disc 30% include PPN. Kuota
                            import min 10.</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                    </div>

                </div>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->name }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Product Name</p>
                    </div>
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->catalog }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Catalog</p>
                    </div>
                    <div>
                        <span class="text-blue-500 dark:text-blue-400 font-bold">{{ $product->ecatalog_link }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">E-Catalog Link</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <!-- Total Quotation -->
                    <div class="w-1/3 p-4 bg-blue-100 dark:bg-blue-900 rounded-lg shadow-md">
                        <p class="text-2xl font-bold text-blue-500 dark:text-blue-300">10</p>
                        <p class="text-sm text-blue-500 dark:text-blue-300">(Rp, 702.652.500)</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Total Quotation</p>
                    </div>
                    <!-- Total Sales Order -->
                    <div class="w-1/3 p-4 bg-teal-100 dark:bg-teal-900 rounded-lg shadow-md">
                        <p class="text-2xl font-bold text-teal-500 dark:text-teal-300">7</p>
                        <p class="text-sm text-teal-500 dark:text-teal-300">(Rp, 462.370.500)</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Total Sales Order</p>
                    </div>
                    <!-- Outstanding Sales Order -->
                    <div class="w-1/3 p-4 bg-red-100 dark:bg-red-900 rounded-lg shadow-md">
                        <p class="text-2xl font-bold text-red-500 dark:text-red-300">5</p>
                        <p class="text-sm text-red-500 dark:text-red-300">(Rp, 333.000.000)</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Outstanding Sales Order</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="edit" role="tabpanel"
            aria-labelledby="edit-tab">
            <form class="p-4 md:p-5" action="{{ route('products.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-4">
                    <div class="col-span-2 ">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            Name</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="col-span-2 ">
                        <label for="catalog"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catalog</label>
                        <input type="text" name="catalog" id="catalog" value="{{ $product->catalog }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="col-span-2 ">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled>Select Category</option>
                            <option value="Assykit" {{ $product->category == 'Assykit' ? 'selected' : '' }}>Assykit
                            </option>
                            <option value="Instrument" {{ $product->category == 'Instrument' ? 'selected' : '' }}>
                                Instrument</option>
                            <option value="Consumable" {{ $product->category == 'Consumable' ? 'selected' : '' }}>
                                Consumable</option>
                            <option value="Other" {{ $product->category == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-span-2 ">
                        <label for="brand_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand
                            Name</label>
                        <select id="brand_id" name="brand_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled>Select Brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 ">
                        <label for="ecatalog_link"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ECatalog Link</label>
                        <input type="text" name="ecatalog_link" id="ecatalog_link"
                            value="{{ $product->ecatalog_link }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2 ">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="attachment">Attachment</label>
                        <input type="file" accept=".pdf,.doc,.docx,.ppt,.pptx"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="attachment_help" id="attachment" name="attachment">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="attachment_help">PDF, Doc, PPT
                            MAX(5mb)</p>
                    </div>
                    @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
                        <div class="col-span-2 ">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option disabled {{ $product->status ?? 'selected' }}>Select Status</option>
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="non_active" {{ $product->status == 'non_active' ? 'selected' : '' }}>
                                    Non Active</option>
                            </select>
                        </div>
                        <div class="col-span-2 ">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="text" name="price" id="price" value="{{ $product->price }}"
                                pattern="\d+" title="Masukan Dengan Format Harga Yang Sesuai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-2 ">
                            <label for="stock"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="text" name="stock" id="stock" value="{{ $product->stock }}"
                                pattern="\d+" title="Masukan Dengan Format Stock Yang Sesuai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-2 ">
                            <label for="safety_stock"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Safety Stock</label>
                            <input type="text" name="safety_stock" id="safety_stock" pattern="\d+"
                                title="Masukan Dengan Format Stock Yang Sesuai" value="{{ $product->safety_stock }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    @endif
                    <div class="col-span-2 ">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="w-full flex justify-end"> <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
            aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
            aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
    </div>



    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Detail Product</h2>
                <a class="btn btn-primary mb-3" href="{{ route('products.index') }}">Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form class="p-4 md:p-5" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="catalog">Catalog:</label>
                <input type="text" name="catalog" value="{{ $product->category }}" class="form-control">
            </div>
            <div class="form-group">
                <label>category:</label>
                <select name="category" class="form-control" value="{{ $product->category }}">
                    <option value="{{ $product->category }}" disabled selected>{{ $product->category }}</option>
                    <option value="Assykit">Assykit</option>
                    <option value="Instrument">Instrument</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Brand:</label>
                <select name="brand_id" class="form-control">
                    <option selected value="{{ $product->brand_id }}">{{ $product->brand_name }}</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ecatalog Link:</label>
                <textarea name="ecatalog_link" class="form-control" rows="5">{{ $product->ecatalog_link }}</textarea>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Attachment:</label>
                @if ($product->attachment)
                    <a href="{{ asset('uploads/files/' . $product->attachment) }}" target="_blank">View Current
                        Attachment</a><br>
                @endif
                <input type="file" name="attachment" class="form-control">
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control">
                    <option value="" disabled selected>Select Status</option>
                    <option value="active">Active</option>
                    <option value="non_active">Non Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">stock:</label>
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="safety_stock">safety stock:</label>
                <input type="text" name="safety_stock" value="{{ $product->safety_stock }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> --}}
@endsection
