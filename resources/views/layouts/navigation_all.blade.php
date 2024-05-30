<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative" style="background-color: #DBEECB; padding-right: 20px; padding-left: 20px;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/Logo_Mangrove_Crop.png') }}" alt="Logo Mangrove" style="width: 200px; height: auto;">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link font-bold">
                        {{ __('HOME') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link font-bold">
                        {{ __('LOCATIONS') }}
                    </x-nav-link>
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link font-bold">
                        {{ __('REPORTS') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Login Button -->
            <div class="flex items-center space-x-8">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex relative z-10">
                    @guest <!-- Cek apakah pengguna belum login -->
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="nav-link font-bold">
                            {{ __('LOGIN') }}
                        </x-nav-link>
                    @else <!-- Jika pengguna sudah login -->
                        <a href="{{ route('home') }}" class="nav-link font-bold">{{ Auth::user()->name }}</a>
                    @endguest
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('home') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>

