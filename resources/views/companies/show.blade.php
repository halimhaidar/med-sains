<!-- resources/views/companies/show.blade.php -->

@extends('layouts.dashboard')

@section('content')
<p class="text-xl font-semibold text-gray-900 dark:text-white mb-8">Detail Company</p>
<div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="bg-white dark:bg-gray-800 w-full md:w-1/4 shadow-md rounded-lg">
        <div class="p-6">
            <div class="flex items-center">
                <div id="avatar" class="flex items-center justify-center w-32 h-32 bg-blue-500 text-white text-2xl font-bold rounded-lg">
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-800 dark:text-gray-300 font-bold text-xl">{{ $company->company }}</h2>
                </div>
            </div>
        </div>
        \
        <div class="grid grid-cols-4 gap-2 p-6">
            <div class="ttext-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Creator:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->created_by ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Sales PIC:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->pic ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Created:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->created_at ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Division:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->division ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Phone:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->phone ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Website:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->website ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">NPWP:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3">{{ $company->npwp ?? '-' }}</div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Address:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3 break-words">
                {{ $company->address ?? '-' }}
            </div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Segment:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3 break-words">
                {{ $company->segment ?? '-' }}
            </div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Sub-Segment:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3 break-words">
                {{ $company->sub_segment ?? '-' }}
            </div>

            <div class="text-gray-600 dark:text-gray-500 text-left font-bold col-span-1">Post Code:</div>
            <div class="text-gray-600 dark:text-gray-500 text-right col-span-3 break-words">
                {{ $company->post_code ?? '-' }}
            </div>
        </div>
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            {{-- <ul>
                    <li class="mb-2"><a href="#" class="text-blue-500 dark:text-blue-300">Profile Overview</a></li>
                    <li class="mb-2"><a href="#" class="text-gray-600 dark:text-gray-500">Discussion</a></li>
                    <li class="mb-2"><a href="#" class="text-gray-600 dark:text-gray-500">Data Leads (6)</a></li>
                    <li class="mb-2"><a href="#" class="text-gray-600 dark:text-gray-500">Data Quotation (104)</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-gray-600 dark:text-gray-500">Data Sales Sample</a></li>
                </ul> --}}
        </div>
    </div>

    <div class="w-full md:w-3/4 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md h-96">
            <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-lg shadow-md">
                <h4 class="text-yellow-800 dark:text-yellow-300 font-bold text-xl">6</h4>
                <p class="text-yellow-600 dark:text-yellow-400">Total Lead</p>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg shadow-md">
                <h4 class="text-blue-800 dark:text-blue-300 font-bold text-xl">104 <span class="text-blue-600 dark:text-blue-400 text-sm">(Rp. 8,312,671,150)</span></h4>

                <p class="text-blue-600 dark:text-blue-400">Total Quotation</p>
            </div>
            <div class="bg-teal-100 dark:bg-teal-900 p-4 rounded-lg shadow-md">
                <h4 class="text-teal-800 dark:text-teal-300 font-bold text-xl">82 <span class="text-teal-600 dark:text-teal-400 text-sm">(Rp. 6,955,267,850)</span></h4>

                <p class="text-teal-600 dark:text-teal-400">Total Sales Order</p>
            </div>
            <div class="bg-red-100 dark:bg-red-900 p-4 rounded-lg shadow-md">
                <h4 class="text-red-800 dark:text-red-300 font-bold text-xl">10 <span class="text-red-600 dark:text-red-400 text-sm">(Rp. 629,029,800)</span></h4>

                <p class="text-red-600 dark:text-red-400">Outstanding Sales Order</p>
            </div>
        </div>
        <div class="mt-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md h-96">
                <h3 class="text-gray-800 dark:text-gray-300 font-bold text-xl mb-4 text-center">Brand Qty of Sales Order
                </h3>
                {{-- <canvas id="salesOrderChart"></canvas> --}}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function createInitialsAvatar(name) {
            const initials = name.split(' ').map(word => word[0]).join('');
            document.getElementById('avatar').textContent = initials.toUpperCase();
        }
        createInitialsAvatar('{{ $company->company }}')
    });

</script>
@endsection
