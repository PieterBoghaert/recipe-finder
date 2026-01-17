<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Discover quick, whole-food recipes that anyone can master—no fancy equipment, no ultra-processed shortcuts—just honest ingredients and straightforward steps.">
    <meta name="author" content="Boghaert Pieter">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-32x32.png') }}">

    {{-- Page Title --}}
    <title>{{ $title ?? 'Recipe Finder' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="site-content {{ $pageClass ?? '' }}">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>