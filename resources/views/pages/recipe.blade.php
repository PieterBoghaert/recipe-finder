<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $slug }} - Recipe Finder</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="container">
        <livewire:recipe-detail :slug="$slug" />
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>