@props(['current' => ''])

<nav class="navigation" role="navigation" aria-label="Main navigation">



    <div class="navigation__wrapper">
        {{-- Logo --}}
        <div class="navigation__logo">
            <a href="{{ route('home') }}" class="navigation__logo-link" wire:navigate>
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Recipe Finder" width="195" height="40">
            </a>
        </div>
        {{-- Mobile Menu Toggle (Checkbox Hack) --}}
        <input type="checkbox" id="menu-toggle" class="navigation__toggle" aria-label="Toggle navigation menu">
        {{-- Hamburger Icon (Label for Checkbox) --}}
        <label for="menu-toggle" class="navigation__hamburger" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </label>

        {{-- Navigation Links --}}
        <ul class="navigation__menu">
            <li class="navigation__item">
                <a href="{{ route('home') }}"
                    class="navigation__link {{ request()->routeIs('home') ? 'navigation__link--active' : '' }}"
                    wire:navigate>
                    Home
                </a>
            </li>
            <li class="navigation__item">
                <a href="{{ route('about') }}"
                    class="navigation__link {{ request()->routeIs('about') ? 'navigation__link--active' : '' }}"
                    wire:navigate>
                    About
                </a>
            </li>
            <li class="navigation__item">
                <a href="{{ route('recipes') }}"
                    class="navigation__link {{ request()->routeIs('recipes') ? 'navigation__link--active' : '' }}"
                    wire:navigate>
                    Recipes
                </a>
            </li>
            <li class="navigation__item navigation__item--cta">
                <a href="{{ route('recipes') }}" class="btn" wire:navigate>
                    Browse Recipes
                </a>
            </li>
        </ul>

    </div>
</nav>