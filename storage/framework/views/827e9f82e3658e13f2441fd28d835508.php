<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder - Home</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/scss/app.scss', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body>
    <?php if (isset($component)) { $__componentOriginalf75d29720390c8e1fa3307604849a543 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf75d29720390c8e1fa3307604849a543 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navigation','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navigation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf75d29720390c8e1fa3307604849a543)): ?>
<?php $attributes = $__attributesOriginalf75d29720390c8e1fa3307604849a543; ?>
<?php unset($__attributesOriginalf75d29720390c8e1fa3307604849a543); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf75d29720390c8e1fa3307604849a543)): ?>
<?php $component = $__componentOriginalf75d29720390c8e1fa3307604849a543; ?>
<?php unset($__componentOriginalf75d29720390c8e1fa3307604849a543); ?>
<?php endif; ?>

    <main>

        <section class="homepage-intro">
            <div class="wrapper">
                <h1 class="homepage-intro__title">Healthy meals, zero fuss</h1>
                <p class="homepage-intro__description">Discover eight quick, whole-food recipes that you can cook tonight—no processed junk, no guesswork.</p>
                <a href="<?php echo e(url('/recipes')); ?>" class="btn homepage-intro__btn" wire:navigate>Start exploring</a>
                <picture class="homepage-intro__image-wrapper">
                    <source srcset="<?php echo e(asset('assets/images/image-home-hero-large.webp')); ?>" media="(min-width: 640px)">
                    <img src="<?php echo e(asset('assets/images/image-home-hero-small.webp')); ?>" alt="Delicious healthy meal" class="homepage-intro__image">
                </picture>
            </div>
        </section>

        <section class="homepage-features">
            <div class="wrapper">
                <h2>What you'll get</h2>
                <div class="homepage-features__grid">
                    <div class="homepage-features__item">
                        <div class="homepage-features__icon-wrapper">
                            <img src="<?php echo e(asset('assets/images/icon-whole-food-recipes.svg')); ?>" alt="Whole food recipes icon" class="homepage-features__icon">
                        </div>
                        <h3>Whole-food recipes</h3>
                        <p>Each dish uses everyday, unprocessed ingredients.</p>
                    </div>
                    <div class="homepage-features__item">
                        <div class="homepage-features__icon-wrapper">
                            <img src="<?php echo e(asset('assets/images/icon-minimum-fuss.svg')); ?>" alt="Minimum fuss icon" class="homepage-features__icon">
                        </div>
                        <h3>Minimum fuss</h3>
                        <p>All recipes are designed to make eating healthy quick and easy.</p>
                    </div>
                    <div class="homepage-features__item">
                        <div class="homepage-features__icon-wrapper">
                            <img src="<?php echo e(asset('assets/images/icon-search-in-seconds.svg')); ?>" alt="Search in seconds icon" class="homepage-features__icon">
                        </div>
                        <h3>Search in seconds</h3>
                        <p>Filter by name or ingredient and jump straight to the recipe you need.</p>
                    </div>
                </div>
        </section>

        <section class="homepage-reallife has-full-line">
            <div class="wrapper">
                <div class="homepage-reallife__grid">
                    <div class="homepage-reallife__text">
                        <h2>Built for real life</h2>
                        <p>Cooking shouldn’t be complicated. These recipes come in under 30 minutes of active time, fit busy schedules, and taste good enough to repeat. </p>
                        <p>Whether you’re new to the kitchen or just need fresh ideas, we’ve got you covered.</p>
                    </div>
                    <div class="homepage-reallife__image">
                        <picture>
                            <source srcset="<?php echo e(asset('assets/images/image-home-real-life-large.webp')); ?>" media="(min-width: 640px)">
                            <img src="<?php echo e(asset('assets/images/image-home-real-life-small.webp')); ?>" alt="Person cooking in a kitchen" class="homepage-reallife__img">
                        </picture>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php if (isset($component)) { $__componentOriginala649cfbd6b1ff6fb80672d9879217508 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala649cfbd6b1ff6fb80672d9879217508 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cta','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala649cfbd6b1ff6fb80672d9879217508)): ?>
<?php $attributes = $__attributesOriginala649cfbd6b1ff6fb80672d9879217508; ?>
<?php unset($__attributesOriginala649cfbd6b1ff6fb80672d9879217508); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala649cfbd6b1ff6fb80672d9879217508)): ?>
<?php $component = $__componentOriginala649cfbd6b1ff6fb80672d9879217508; ?>
<?php unset($__componentOriginala649cfbd6b1ff6fb80672d9879217508); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/pages/home.blade.php ENDPATH**/ ?>