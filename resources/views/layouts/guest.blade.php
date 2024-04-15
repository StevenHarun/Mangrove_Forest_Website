<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body.custom-bg {
            background-image: url('/images/bg_dashboard.jpg');
            background-size: cover;
            /* Add other background styles here */
        }
        .custom-rectangle {
            position: absolute;
            height: 100vh;
            width: calc(100% - 85%);
            margin-left: 45%;
            background-color: #B5DB9E;
        }
    </style>
</head>
<div class="custom-rectangle"></div>
<body class="font-sans text-gray-900 antialiased min-h-screen bg-gray-100 custom-bg">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-3/5 mt- px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg" style="background-color: #F6FAE9; height: 100vh; width: 40%; margin-left: 60%;">
            {{ $slot }}
        </div>
        
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
