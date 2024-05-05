<x-app-layout>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-5 text-gray-700"> --}}
                {{-- <div class="max-w-md mx-auto">      --}}
                    <!-- Header Table -->
                    <div style="background-color: #75B896; color: white;" class="text-center py-2 mb-4 text-2xl">
                        CREATE REPORT
                    </div>
                    <!-- Table -->
                    <div class="bg-white rounded-lg shadow-lg px-4 py-1">
    
                        <!-- Title 'USER DETAILS' -->
                        {{-- <h2 class="text-center text-3xl mb-3 text-gray-700">CREATE DAMAGE REPORT</h2> --}}
    
                        <!-- Form Registrasi -->
                        <form enctype="multipart/form-data" action="{{ route('report.store') }}" method="POST" >
                            @csrf
                            <!-- Name -->
                            <div class="mt-4 grid grid-cols-2">
                                <label for="report_title" class="text-gray-700">Report Title</label>
                                <x-text-input id="report_title" class="block mt-1 w-full" type="text" name="report_title" :value="old('report_title')" required autofocus autocomplete="report_title" />
                                <x-input-error :messages="$errors->get('report_title')" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div class="mt-4 grid grid-cols-2">
                                <label for="category" class="text-gray-700">Category</label>
                                <div class="relative">
                                    <select id="category" name="category" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow-sm focus:outline-none focus:border-indigo-500">
                                        <option value="Kerusakan">Kerusakan</option>
                                        <option value="Penghijauan">Penghijauan</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        {{-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            {{-- <path d="M6 9l6 6 6-6"></path> --}}
                                        {{-- </svg> --}}
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div class="mt-4 grid grid-cols-2">
                                <label for="location" class="text-gray-700">Location</label>
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required autocomplete="off" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                            
                            {{-- Date --}}
                            <div class="mt-4 grid grid-cols-2">
                                <label for="date" class="text-gray-700">Date</label>
                                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" required />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
                                                      
                            {{-- Image --}}
                            <div class="mt-4 grid grid-cols-2">
                                <label for="image" class="text-gray-700">Upload Image</label>
                                <input id="image" name="image" type="file" class="block mt-1 w-full" accept="image/*">
                                <!-- Add any additional validation error handling here -->
                            </div>

                            <!-- Deskripsi -->
                            <div class="mt-4">
                                <label for="description" class="text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            

                            <!-- Tombol Register -->
                            <div class="flex items-center justify-center mt-4">
                                <x-primary-button class="ms-4" style="background-color: #75B896; color: white;">
                                    {{ __('Add Report') }}
                                </x-primary-button>
                            </div>

                            {{-- Notification Alert --}}
                            @if(session('success'))
                                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-2" role="alert">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg @click="show = false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <title>Close</title>c1
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

</x-app-layout>
