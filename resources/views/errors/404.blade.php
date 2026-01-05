<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Recipe Finder</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <x-navigation />

    <main class="container" style="padding-block: var(--space-800); text-align: center;">
        <div style="max-width: 600px; margin: 0 auto;">
            {{-- Large 404 Text --}}
            <div style="font-size: clamp(4rem, 10vw, 8rem); font-weight: var(--font-weight-bold); color: var(--color-primary-500); line-height: 1; margin-bottom: var(--space-400);">
                404
            </div>

            {{-- Heading --}}
            <h1 style="font-size: clamp(1.5rem, 4vw, 2.5rem); margin-bottom: var(--space-400); color: var(--color-text-primary);">
                Recipe Not Found
            </h1>

            {{-- Description --}}
            <p style="font-size: var(--font-size-110); color: var(--color-text-secondary); margin-bottom: var(--space-600); line-height: var(--line-height-relaxed);">
                Sorry, the recipe you're looking for doesn't exist or has been removed.
                Let's get you back to discovering delicious recipes!
            </p>

            {{-- Action Buttons --}}
            <div style="display: flex; gap: var(--space-400); justify-content: center; flex-wrap: wrap;">
                <a href="{{ url('/') }}" class="button button--primary">
                    Go to Home
                </a>
                <a href="{{ url('/recipes') }}" class="button button--outline">
                    Browse All Recipes
                </a>
            </div>

            {{-- Decorative SVG Icon --}}
            <div style="margin-top: var(--space-800); opacity: 0.1;">
                <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor" style="display: block; margin: 0 auto;">
                    <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.2-1.1-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z" />
                </svg>
            </div>
        </div>
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>