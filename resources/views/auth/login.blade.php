<x-guest-layout>
    <!-- Back Button -->
    <div class="flex items-center justify-start mt-8 ml-4">
        <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 rounded-full" style="background-color: #B5DB9E; outline: none;"> <!-- Tombol back bundar berwarna B5DB9E di atas kiri -->
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
    </div> 
    
    <div class="flex flex-col items-center h-full">  {{-- justify-center --}}
        <div class="mt-20  mb-6 text-2xl font-bold" style="color: #75B896; font-size: 50px; font-weight: bold;">LOGIN</div> <!-- Tulisan LOGIN dengan warna 75B896 -->
        <div class="mb-4 text-lg" style="color: #DCEECB; font-size: 38px; font-weight: bold;">---account---</div> <!-- Tulisan ---account--- dengan warna DCEECB -->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-70%" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-70%%"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-center mt-8">
                <x-primary-button style="color: #75B896;">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
