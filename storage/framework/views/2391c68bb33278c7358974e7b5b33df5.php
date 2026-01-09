<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['recipe']));

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

foreach (array_filter((['recipe']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<article class="recipe-card">
    <a href="<?php echo e(route('recipe.show', $recipe->slug)); ?>" class="recipe-card__link" wire:navigate>
        
        <div class="recipe-card__image-wrapper">
            <picture>
                <source srcset="<?php echo e(asset($recipe->image_small)); ?>" media="(max-width: 640px)">
                <img
                    src="<?php echo e(asset($recipe->image_large)); ?>"
                    alt="<?php echo e($recipe->title); ?>"
                    class="recipe-card__image"
                    style="view-transition-name: recipe-image-<?php echo e($recipe->slug); ?>;"
                    width="1024"
                    height="1024"
                    loading="lazy">
            </picture>
        </div>

        
        <div class="recipe-card__content">
            <h5 class="recipe-card__title"><?php echo e($recipe->title); ?></h5>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recipe->overview): ?>
            <p class="recipe-card__description"><?php echo e(Str::limit($recipe->overview, 100)); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="recipe-card__meta">
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-servings.svg')); ?>" alt="Servings Icon" />
                    <?php echo e($recipe->servings); ?> servings
                </span>
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-prep-time.svg')); ?>" alt="Prep Time Icon" />
                    Prep: <?php echo e($recipe->prep_minutes); ?>m
                </span>
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-cook-time.svg')); ?>" alt="Cook Time Icon" />
                    Cook: <?php echo e($recipe->cook_minutes); ?>m
                </span>

            </div>
        </div>
        
        <span class="recipe-card__button btn btn--full">View Recipe</span>
    </a>
</article><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/components/recipe-card.blade.php ENDPATH**/ ?>