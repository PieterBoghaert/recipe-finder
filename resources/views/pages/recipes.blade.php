<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - Recipe Finder</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="container">
        <div class="page-header">
            <h1>All Recipes</h1>
            <p>Browse our collection of delicious recipes. Use the filters to find exactly what you're looking for.</p>
        </div>

        <livewire:recipe-list />
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>