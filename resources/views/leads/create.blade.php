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
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-10">
        Create Leads
    </h2>
    <div
        class="w-full text-gray-500 bg-white border border-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">
        <ol id="steps"
            class="flex items-center w-full space-x-2 text-sm font-medium text-center sm:text-base m:p-4 sm:space-x-4 rtl:space-x-reverse">
            <li class="step flex items-center text-blue-600 dark:text-blue-500 w-1/2 ps-6 border-b-4 border-blue-600">
                <div class="p-4 text-right">
                    <span class="text-3xl">
                        1.
                    </span>
                    <span class="text-lg">
                        Contact Info
                    </span>
                </div>
            </li>
            <li class="step flex items-center w-1/2  border-b-4 border-gray-400">
                <div class="p-4 text-right">
                    <span class="text-3xl">
                        2.
                    </span>
                    <span class="text-lg">
                        Lead Information
                    </span>
                </div>
            </li>
        </ol>
        <form class="ps-5" method="GET" action="{{ route('leads.create') }}">
            <div id="step-1" class="pt-5 ps-5">
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
                    <button type="submit"
                        class="text-white ms-5 max-w-fit bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Choose
                    </button>
                </div>
            </div>
        </form>
        <form id="multi-step-form" class="p-10" action="{{ route('leads.store') }}" method="POST">
            @csrf
            <!-- Step 1: User Details -->
            <div id="step-1.1" class="step">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="col-span-2">
                        <label for="contact_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                            ID</label>
                        <input type="text" name="contact_id" id="contact_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ isset($contact) ? $contact->id : '' }}" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="contact_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                            Name</label>
                        <input type="text" name="contact_name" id="contact_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ isset($contact) ? $contact->name : '' }}"readonly>
                    </div>
                    <div class="col-span-2 ">
                        <label for="contact_phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                            Phone</label>
                        <input type="text" name="contact_phone" id="contact_phone" pattern="[0-9]+"
                            title="Only numbers are allowed"
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
                        <label for="contact_email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                            Email</label>
                        <input type="text" name="contact_email" id="contact_email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ isset($contact) ? $contact->email : '' }}"readonly>
                    </div>
                </div>
                <div class="flex w-full justify-end">
                    <button type="button" id="next-1" disabled="true"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed dark:disabled:bg-gray-700 dark:disabled:text-gray-500">
                        Next: Lead Information
                    </button>
                </div>
            </div>

            <!-- Step 2: Password Details -->
            <div id="step-2" class="step hidden">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
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
                        <div class="col-span-2">
                            <label for="assign_to"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign
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
                            <label for="assign_to"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign
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
                <div class="flex justify-between">
                    <button type="button" id="prev-2"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Previous: Contact Info
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        const step1 = document.getElementById('step-1');
        const step11 = document.getElementById('step-1.1');
        const step2 = document.getElementById('step-2');
        const next1 = document.getElementById('next-1');
        const prev2 = document.getElementById('prev-2');
        const steps = document.querySelectorAll('.step');

        // Show Step 2 and hide Step 1
        next1.addEventListener('click', function() {
            let currentStepIndex = 0;
            // Find the current active step
            steps.forEach((step, index) => {
                if (step.classList.contains('text-blue-600')) {
                    currentStepIndex = index;
                }
            });

            // Move to the next step
            if (currentStepIndex < steps.length - 1) {
                steps[currentStepIndex].classList.remove('text-blue-600', 'dark:text-blue-500', "border-blue-600");
                steps[currentStepIndex].classList.add('text-gray-500', 'dark:text-gray-400', "border-gray-400");

                steps[currentStepIndex + 1].classList.remove('text-gray-500', 'dark:text-gray-400',
                    "border-gray-400");
                steps[currentStepIndex + 1].classList.add('text-blue-600', 'dark:text-blue-500', "border-blue-600");
            }
            step1.classList.add('hidden');
            step11.classList.add('hidden');
            step2.classList.remove('hidden');
        });

        // Show Step 1 and hide Step 2
        prev2.addEventListener('click', function() {
            let currentStepIndex = 0;

            // Find the current active step
            steps.forEach((step, index) => {
                if (step.classList.contains('text-blue-600')) {
                    currentStepIndex = index;
                }
            });

            // Move to the previous step
            if (currentStepIndex > 0) {
                steps[currentStepIndex].classList.remove('text-blue-600', 'dark:text-blue-500', "border-blue-600");
                steps[currentStepIndex].classList.add('text-gray-500', 'dark:text-gray-400', "border-gray-400");

                steps[currentStepIndex - 1].classList.remove('text-gray-500', 'dark:text-gray-400',
                    "border-gray-400");
                steps[currentStepIndex - 1].classList.add('text-blue-600', 'dark:text-blue-500', "border-blue-600");
            }
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            step11.classList.remove('hidden');
        });
        document.addEventListener('DOMContentLoaded', function() {
            const contactIdInput = document.getElementById('contact_id');
            const submitBtn = document.getElementById('next-1');

            // Disable submit button if contact_id is empty
            function checkContactId() {
                if (!contactIdInput.value.trim()) {
                    submitBtn.disabled = true; // Disable submit button
                } else {
                    submitBtn.disabled = false; // Enable submit button
                }
            }

            checkContactId();

        });
    </script>
@endsection
