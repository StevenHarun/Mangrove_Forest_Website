<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include the Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .min-h-screen.bg-gray-100 {
            background-image: url('/images/bg_dashboard.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen bg-gray-100">
    <!-- Kotak di atas latar belakang -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-lg flex flex-col items-center z-10" style="background-color: #F2FAE9; width: 500px; padding: 20px; border-radius: 30px;">
        <!-- Logo -->
        <div class="flex justify-center w-full">
            <img src="{{ asset('images/Logo_Mangrove_Crop.png') }}" alt="Logo Mangrove Map" style="width: 250px; height: auto; margin-top: 10px;">
        </div> 
    
        <!-- Garis -->
        <hr style="width: 85%; border: 1px solid grey; margin: 20px 0;">
    
        <!-- Copywriting -->
        <div class="text-justify mb-4 text-lg font-bold px-2">
            <p>
                Welcome to Mangrove Map! Dive into the wonders of our marine ecosystem and discover how we can protect our precious planet together. Ready to embark on this journey with us? Let's get started!
            </p>
        </div>
        
        <!-- Tombol -->
        <a href="{{ route('home') }}" class="bg-green-600 rounded-full px-8 py-3 font-bold mt-4">
            <span class="text-white">Let's Explore</span>
        </a>
    </div>
    
    <!-- Page Content -->
    @include('layouts.navigation_all')
    <!-- Page Heading -->
    {{-- @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif --}}
</body>
</html>
