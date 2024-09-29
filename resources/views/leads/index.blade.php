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
        <form class="max-w-md" method="GET" action="{{ route('leads.index') }}">
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
        <a type="button" href="{{ route('leads.create') }}""
            class="block pt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Add New Lead
        </a>
    </div>
    <div class=" overflow-x-auto shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Source
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Segment
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assign To
                    </th>
                    <th scope="col" class="px-6 py-3 min-w-[300px]">
                        Action
                    </th>
                </tr>
            </thead>
            @foreach ($leads as $lead)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $lead->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $lead->contact_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->contact_phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->contact_email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->contact_company }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->source }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->segment }}
                    </td>
                    <td class="px-6 py-4">
                        {{ ucfirst($lead->status) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $lead->fullname }}
                    </td>
                    <td>
                        <a href="{{ route('leads.show', $lead->id) }}"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"">Details</a>
                        @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
                            {{-- Delete Modal --}}
                            <button data-modal-target="popup-modal{{ $lead->id }}"
                                data-modal-toggle="popup-modal{{ $lead->id }}"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5"
                                type="button">
                                Delete
                            </button>
                            <div id="popup-modal{{ $lead->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal{{ $lead->id }}">
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
                                                sure you want to delete lead {{ $lead->contact_name }} ?</h3>
                                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal{{ $lead->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal{{ $lead->id }}" type="button"
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
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
            aria-label="Table navigation">
            <span
                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $leads->firstItem() }}</span>
                to
                <span class="font-semibold text-gray-900 dark:text-white">{{ $leads->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $leads->total() }}</span>
            </span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                @if ($leads->onFirstPage())
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $leads->previousPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                @endif

                @foreach ($leads->links()->elements[0] as $page => $url)
                    @if ($page == $leads->currentPage())
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

                @if ($leads->hasMorePages())
                    <li>
                        <a href="{{ $leads->nextPageUrl() }}"
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

    {{-- End Create Modal --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Leads</h2>
                <a class="btn btn-success mb-3" href="{{ route('leads.create') }}">Create New Lead</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contact Name</th>
                    <th>Contact Phone</th>
                    <th>Contact Email</th>
                    <th>Company</th>
                    <th>Source</th>
                    <th>Segment</th>
                    <th>Status</th>
                    <th>Assign To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->contact_name }}</td>
                        <td>{{ $lead->contact_phone }}</td>
                        <td>{{ $lead->contact_email }}</td>
                        <td>{{ $lead->contact_company }}</td>
                        <td>{{ $lead->source }}</td>
                        <td>{{ $lead->segment }}</td>
                        <td>{{ ucfirst($lead->status) }}</td>
                        <td>{{ $lead->fullname }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('leads.show', $lead->id) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('leads.edit', $lead->id) }}">Edit</a>
                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
@endsection
