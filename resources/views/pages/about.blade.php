<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Recipe Finder</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="container">
        <h1>About Recipe Finder</h1>
        <p>Learn more about our recipe collection.</p>
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>