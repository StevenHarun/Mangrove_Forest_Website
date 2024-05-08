<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6" />
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- <div class="p-5 text-gray-700"> --}}
            {{-- <div class="max-w-md mx-auto">      --}}
            <!-- Header Table -->
            <div style="background-color: #75B896; color: white;" class="text-center py-2 mb-4 text-xl">
                Add Year
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-lg px-4 py-6">

                <!-- Button back -->
                <a href="{{ url()->previous() }}" class="underline" >Back</a>

                <!-- Title 'Locations DETAILS' -->
                <h2 class="text-center text-3xl mb-3 text-gray-700">YEAR DETAILS</h2>

                <!-- Form Registrasi -->
                <form method="POST" action="{{ route('year.update', $year->id) }}">
                    @csrf
                    @method('patch')

                    <!-- Tahun -->
                    <div class="mt-4 grid grid-cols-2">
                        <label for="year" class="text-gray-700">Year</label>
                        <x-text-input id="year" class="block mt-1 w-full" type="text" name="year" value="{{$year->year}}" required autofocus autocomplete="2017" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <!-- Tombol Add -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4" style="background-color: #75B896; color: white;">
                            {{ __('Update year') }}
                        </x-primary-button>
                    </div>

                    {{-- Notification Alert --}}
                    @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg @click="show = false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path fill-rule="evenodd" d="M14.348 5.652a.5.5 0 0 0-.708 0L10 9.293 6.36 5.652a.5.5 0 1 0-.708.708L9.293 10l-3.64 3.64a.5.5 0 0 0 .708.708L10 10.707l3.64 3.64a.5.5 0 0 0 .708-.708L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z" />
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
</x-app-layout>