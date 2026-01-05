<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder - Home</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="container">
        <h1>Welcome to Recipe Finder</h1>
        <p>Browse our collection of delicious recipes.</p>
        <a href="{{ url('/recipes') }}" class="button button--primary">Browse Recipes</a>
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>