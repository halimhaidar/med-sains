<!-- resources/views/companies/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <p class="text-xl font-semibold text-gray-900 dark:text-white">Edit Company</p>
    <form class="p-4 md:p-5" action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4 grid-cols-4">
            <div class="col-span-2">
                <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                <input type="text" name="company" id="company" value="{{ $company->company }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                <input type="text" name="division" id="division" value="{{ $company->division }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ $company->phone }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website</label>
                <input type="text" name="website" id="website" value="{{ $company->website }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="social_media" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Social
                    Media</label>
                <input type="text" name="social_media" id="social_media" value="{{ $company->social_media }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="npwp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NPWP</label>
                <input type="text" name="npwp" id="npwp" value="{{ $company->npwp }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
            </div>
            <div class="col-span-2 ">
                <label for="post_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                    Code</label>
                <input type="text" name="post_code" id="post_code" value="{{ $company->post_code }}"
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
                    <option value="hospital" {{ $company->segment == 'hospital' ? 'selected' : '' }}>Hospital</option>
                    <option value="industry" {{ $company->segment == 'industry' ? 'selected' : '' }}>Industry</option>
                    <option value="education" {{ $company->segment == 'education' ? 'selected' : '' }}>Education
                    </option>
                </select>
            </div>
            <div class="col-span-2 ">
                <label for="sub_segment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub
                    Segment</label>
                <select id="sub_segment" name="sub_segment" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected disabled>Select Sub-Segment</option>
                    <option value="farmasi" {{ $company->sub_segment == 'farmasi' ? 'selected' : '' }}>Farmasi</option>
                    <option value="chemical" {{ $company->sub_segment == 'chemical' ? 'selected' : '' }}>Chemical
                    </option>
                    <option value="biological" {{ $company->sub_segment == 'biological' ? 'selected' : '' }}>Biological
                    </option>
                    <option value="">Select Sub-Segment</option>
                </select>
            </div>
            <input type="hidden" name="sub_segment" id="sub_segment_hidden" value="">
            <div class="col-span-2 ">
                <label for="pic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sales PIC</label>
                <select id="pic" name="pic"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected disabled>Select Sales PIC</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->fullname }}" {{ $company->pic == $user->fullname ? 'selected' : '' }}>
                            {{ $user->fullname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <textarea id="address" name="address" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                        rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $company->address }}</textarea>
            </div>
        </div>
        <div class="w-full flex justify-end"> <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit Company
            </button></div>
    </form>>
@endsection
