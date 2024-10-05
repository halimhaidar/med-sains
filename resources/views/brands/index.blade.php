@extends('layouts.dashboard')

@section('content')
    {{-- Success Message --}}
    @if (session('success'))
        <div id="successMessage"
            class="bg-green-400 border border-green-400 text-black dark:text-white px-4 py-3 rounded-lg mb-5" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div id="successMessage"
            class="bg-green-400 border border-green-400 text-black dark:text-white px-4 py-3 rounded-lg mb-5" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    {{-- End Success Message --}}

    {{-- Errors Message --}}
    @if ($errors->any())
        <div id="errorMessage" class="top-4 right-4 mb-5 mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- End Errors Message --}}
    <div class="flex w-full justify-between">
        <form class="max-w-md" method="GET" action="{{ route('brands.index') }}">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search" name="search" value="{{ request('search') }}""
                    class="block w-full p-4 ps-10 text-sm text-gray-900
                    border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500"
                    placeholder="Search" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Add New brand
        </button>
    </div>
    <div class=" overflow-x-auto shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Brand Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SQ Target
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SO Target
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sales Target
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Handle By
                    </th>
                    <th scope="col" class="px-6 py-3 min-w-[300px]">
                        Action
                    </th>
                </tr>
            </thead>
            @foreach ($brands as $brand)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $brand->id }}
                    </th>
                    <td class="px-6 py-4">
                        <strong>{{ $brand->name }}</strong><br>
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($brand->sq_target, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($brand->so_target, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($brand->sales_target, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $brand->category_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $brand->created_at->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $brand->handle_by }}
                    </td>
                    <td>
                        <a href="{{ route('brands.show', $brand->id) }}"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"">Details</a>
                        @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
                            {{-- Delete Modal --}}
                            <button data-modal-target="popup-modal{{ $brand->id }}"
                                data-modal-toggle="popup-modal{{ $brand->id }}"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5"
                                type="button">
                                Delete
                            </button>
                            <div id="popup-modal{{ $brand->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal{{ $brand->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you
                                                sure you want to delete brand {{ $brand->name }} ?</h3>
                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal{{ $brand->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal{{ $brand->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Modal --}}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 pb-2 pe-1"
            aria-label="Table navigation">
            <span
                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $brands->firstItem() }}</span>
                to
                <span class="font-semibold text-gray-900 dark:text-white">{{ $brands->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $brands->total() }}</span>
            </span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                @if ($brands->onFirstPage())
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $brands->previousPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                @endif

                @foreach ($brands->links()->elements[0] as $page => $url)
                    @if ($page == $brands->currentPage())
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                @if ($brands->hasMorePages())
                    <li>
                        <a href="{{ $brands->nextPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                @else
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
        {{-- End Pagination --}}
    </div>

    <!-- Create Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add New brand
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('brands.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-4">
                        <div class="col-span-2 ">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-2 ">
                            <label for="handle_by"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Handle By</label>
                            <input type="text" name="handle_by" id="handle_by"
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
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 ">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="image_brand">Upload file</label>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="image_brand_help" id="image_brand" name="image_brand">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_brand_help"> PNG, JPG, JPEG
                                or
                                GIF (MAX. 2MB).</p>
                        </div>
                        <div class="col-span-2 ">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="w-full flex justify-end"> <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add New Brands
                        </button></div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Create Modal --}}
@endsection
