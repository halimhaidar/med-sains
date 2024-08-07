@extends('layouts.dashboard')

@section('content')
    <p class="text-xl font-semibold text-gray-900 dark:text-white">Edit contact</p>
    @if ($errors->any())
        <div id="errorMessage" class="top-4 right-4 mb-5 mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="p-4 md:p-5" action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4 grid-cols-4">
            <div class="col-span-2">
                <label for="salutation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salutation</label>
                <input type="text" name="salutation" id="salutation" value="{{ $contact->salutation }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name" value="{{ $contact->name }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="academic_degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Academic
                    Degree</label>
                <input type="text" name="academic_degree" id="academic_degree" value="{{ $contact->academic_degree }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="job_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                    Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ $contact->job_title }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <input type="text" name="gender" id="gender" value="{{ $contact->gender }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                <select id="company_id" name="company_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option disabled>Select Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $contact->company_id ? 'selected' : '' }}>
                            {{ $company->company }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2 ">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" value="{{ $contact->email }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ $contact->phone }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                <input type="text" name="province" id="province" value="{{ $contact->province }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                <input type="text" name="city" id="city" value="{{ $contact->city }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="post_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                    Code</label>
                <input type="text" name="post_code" id="post_code" value="{{ $contact->post_code }}"
                    class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                    dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="segment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Segment</label>
                <select id="segment" name="segment" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option disabled>Select Segment</option>
                    <option value="hospital" {{ $contact->segment == 'hospital' ? 'selected' : '' }}>Hospital</option>
                    <option value="industry" {{ $contact->segment == 'industry' ? 'selected' : '' }}>Industry</option>
                    <option value="education" {{ $contact->segment == 'education' ? 'selected' : '' }}>Education
                    </option>
                </select>
            </div>
            <div class="col-span-2 ">
                <label for="sub_segment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub
                    Segment</label>
                <select id="sub_segment" name="sub_segment" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected disabled>Select Sub-Segment</option>
                    <option value="farmasi" {{ $contact->sub_segment == 'farmasi' ? 'selected' : '' }}>Farmasi</option>
                    <option value="chemical" {{ $contact->sub_segment == 'chemical' ? 'selected' : '' }}>Chemical
                    </option>
                    <option value="biological" {{ $contact->sub_segment == 'biological' ? 'selected' : '' }}>Biological
                    </option>
                    <option value="">Select Sub-Segment</option>
                </select>
            </div>
            <input type="hidden" name="sub_segment" id="sub_segment_hidden" value="">
            <div class="col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <textarea id="address" name="address" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                    rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $contact->address }}</textarea>
            </div>
        </div>
        <div class="w-full flex justify-end"> <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit Contact
            </button></div>
    </form>>
@endsection
