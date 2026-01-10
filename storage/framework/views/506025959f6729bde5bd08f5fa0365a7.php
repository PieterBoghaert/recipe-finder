<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['current' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['current' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<nav class="navigation" role="navigation" aria-label="Main navigation">



    <div class="navigation__wrapper">
        
        <div class="navigation__logo">
            <a href="<?php echo e(route('home')); ?>" class="navigation__logo-link" wire:navigate>
                <img src="<?php echo e(asset('assets/images/logo.svg')); ?>" alt="Recipe Finder" width="260" height="40">
            </a>
        </div>
        
        <input type="checkbox" id="menu-toggle" class="navigation__toggle" aria-label="Toggle navigation menu">
        
        <label for="menu-toggle" class="navigation__hamburger" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </label>

        
        <ul class="navigation__menu">
            <li class="navigation__item">
                <a href="<?php echo e(route('home')); ?>"
                    class="navigation__link <?php echo e(request()->routeIs('home') ? 'navigation__link--active' : ''); ?>"
                    wire:navigate>
                    Home
                </a>
            </li>
            <li class="navigation__item">
                <a href="<?php echo e(route('about')); ?>"
                    class="navigation__link <?php echo e(request()->routeIs('about') ? 'navigation__link--active' : ''); ?>"
                    wire:navigate>
                    About
                </a>
            </li>
            <li class="navigation__item">
                <a href="<?php echo e(route('recipes')); ?>"
                    class="navigation__link <?php echo e(request()->routeIs('recipes') ? 'navigation__link--active' : ''); ?>"
                    wire:navigate>
                    Recipes
                </a>
            </li>
            <li class="navigation__item navigation__item--cta">
                <a href="<?php echo e(route('recipes')); ?>" class="btn" wire:navigate>
                    Browse Recipes
                </a>
            </li>
        </ul>

    </div>
</nav><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/components/navigation.blade.php ENDPATH**/ ?>