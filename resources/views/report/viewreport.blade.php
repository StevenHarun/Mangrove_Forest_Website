<x-app-layout>
    
    <style>
        .custom-button {
            background-color: #F2FAE9;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: none;
            /* margin: 4px 2px; */
            cursor: pointer;
            /* border-radius: 4px; */
        }

        .penghijauan {
            color: #49B56D;
        }

        .kerusakan {
            color: #EC9D84;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-5 text-gray-700"> --}}
                {{-- <div class="max-w-md mx-auto">      --}}
                    <!-- Header Table -->
                    <div style="background-color: #75B896; color: white;" class="text-center py-3 mb-1 text-xl">
                        Report History
                    </div>
                    <!-- Table -->
                    <div class="bg-white rounded-lg shadow-lg px-4 py-6">
                        <!-- Title 'USER DETAILS' -->
                        <!-- Form Registrasi -->
                        {{-- <form method="GET" action="{{ route('viewreport') }}"> --}}
                        <form method="POST">
                        @csrf
                        <div class="mt-1">
                            {{-- <a href={{ route('report.report') }} class="custom-button penghijauan">Penghijauan</a>
                            <a href={{ route('report.report') }} class="custom-button kerusakan">Kerusakan</a> --}}
                            <a class="custom-button penghijauan">Penghijauan</a>
                            <a class="custom-button kerusakan">Kerusakan</a>
                        </div>
                        <h2 class="text-center text-3xl mb-3 text-gray-700">USER DETAIL</h2>
                            {{-- Notification Alert --}}
                            @if(session('success'))
                                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg @click="show = false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <title>Close</title>
                                            <path fill-rule="evenodd" d="M14.348 5.652a.5.5 0 0 0-.708 0L10 9.293 6.36 5.652a.5.5 0 1 0-.708.708L9.293 10l-3.64 3.64a.5.5 0 0 0 .708.708L10 10.707l3.64 3.64a.5.5 0 0 0 .708-.708L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z"/>
                                        </svg>
                                    </span>
                                </div>
                            @endif
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@foreach ($reports as $report)
<!-- Assuming $report is the variable passed to the view -->
<img src="{{ route('reports.image', $report->id) }}" alt="Report Image">
@endforeach
</x-app-layout>
