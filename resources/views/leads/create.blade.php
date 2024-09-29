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

    <div class="relative bg-white p-5 dark:bg-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-10">
            Create Leads
        </h3>
        <form class="p-4 md:p-5" method="GET" action="{{ route('leads.create') }}">
            <label for="contact_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Contact Name</label>
            <div class="grid grid-cols-8">
                <select id="contact_name" name="contact_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected>Select Contact Name</option>
                    @foreach ($contactsAll as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($contact) && $item->id == $contact->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                {{-- <button type="submit">Choose</button> --}}
                <button type="submit"
                    class="text-white ms-5 max-w-fit bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Choose
                </button>
            </div>
        </form>

        <form class="p-4 md:p-5" action="{{ route('leads.store') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-4">
                <div class="col-span-2">
                    <label for="contact_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        ID</label>
                    <input type="text" name="contact_id" id="contact_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($contact) ? $contact->id : '' }}" readonly>
                </div>
                <div class="col-span-2">
                    <label for="contact_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Name</label>
                    <input type="text" name="contact_name" id="contact_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($contact) ? $contact->name : '' }}"readonly>
                </div>
                <div class="col-span-2 ">
                    <label for="contact_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($contact) ? $contact->phone : '' }}"readonly>
                </div>
                <div class="col-span-2 ">
                    <label for="contact_company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Company</label>
                    <input type="text" name="contact_company" id="contact_company"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($contact) ? $contact->company : '' }}"readonly>
                </div>
                <div class="col-span-2 ">
                    <label for="contact_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Email</label>
                    <input type="text" name="contact_email" id="contact_email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ isset($contact) ? $contact->email : '' }}"readonly>
                </div>
                <div class="col-span-2 ">
                    <label for="source"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source</label>
                    <select id="source" name="source" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>-Select Source</option>
                        <option value="WA">WA</option>
                        <option value="Email">Email</option>
                    </select>
                </div>
                <div class="col-span-2 ">
                    <label for="segment"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Segment</label>
                    <select id="segment" name="segment" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>-Select Segment</option>
                        <option value="Other">Other</option>
                        <option value="Reseller">Reseller</option>>
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lead
                        Status</label>
                    <input type="text" name="status" id="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin')
                    <!-- Check if the user is admin -->
                    <div class="col-span-2">
                        <label for="assign_to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign
                            To drop:</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            id="assign_to" name="assign_to">
                            <option value="" disabled selected>Choose </option>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="col-span-2">
                        <label for="assign_to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign
                            To</label>
                        <input type="text" name="assign_to"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $user->fullname }}">
                    </div>
                @endif
                <div class="col-span-2">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add New Lead
                </button>
            </div>
        </form>
    </div>
@endsection
