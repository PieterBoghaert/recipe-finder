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

    <main class="site-content">

        <div class="recipes-intro wrapper">
            <h1 class="h2">Explore our simple, healthy recipes</h1>
            <p>Discover eight quick, whole-food dishes that fit real-life schedules and taste amazing. Use the search bar to find a recipe by name or ingredient, or simply scroll the list and let something delicious catch your eye.</p>
        </div>

        <livewire:recipe-list />
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>