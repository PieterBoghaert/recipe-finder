<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Recipe Finder - Home','pageClass' => 'page-home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Recipe Finder - Home','pageClass' => 'page-home']); ?>

    <section class="homepage-intro">
        <div class="wrapper">
            <h1 class="homepage-intro__title"><span>Healthy</span> meals, zero fuss</h1>
            <p class="homepage-intro__description">Discover eight quick, whole-food recipes that you can cook tonight—no processed junk, no guesswork.</p>
            <a href="<?php echo e(url('/recipes')); ?>" class="btn homepage-intro__btn" wire:navigate>Start exploring</a>
            <picture class="homepage-intro__image-wrapper animate-on-scroll animate-fade-in-up">
                <source srcset="<?php echo e(asset('assets/images/image-home-hero-large.webp')); ?>" media="(min-width: 640px)">
                <img src="<?php echo e(asset('assets/images/image-home-hero-small.webp')); ?>" alt="Delicious healthy meal" class="homepage-intro__image" width="686" height="400">
            </picture>
        </div>
    </section>

    <section class="homepage-features">
        <div class="wrapper">
            <h2 class="animate-on-scroll animate-fade-in-up">What you'll get</h2>
            <div class="homepage-features__grid">
                <div class="homepage-features__item animate-on-scroll animate-fade-in-up animate-delay-1">
                    <div class="homepage-features__icon-wrapper">
                        <img src="<?php echo e(asset('assets/images/icon-whole-food-recipes.svg')); ?>" alt="Whole food recipes icon" class="homepage-features__icon">
                    </div>
                    <h3>Whole-food recipes</h3>
                    <p>Each dish uses everyday, unprocessed ingredients.</p>
                </div>
                <div class="homepage-features__item animate-on-scroll animate-fade-in-up animate-delay-2">
                    <div class="homepage-features__icon-wrapper">
                        <img src="<?php echo e(asset('assets/images/icon-minimum-fuss.svg')); ?>" alt="Minimum fuss icon" class="homepage-features__icon">
                    </div>
                    <h3>Minimum fuss</h3>
                    <p>All recipes are designed to make eating healthy quick and easy.</p>
                </div>
                <div class="homepage-features__item animate-on-scroll animate-fade-in-up animate-delay-3">
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
                <div class="homepage-reallife__text animate-on-scroll animate-fade-in-up">
                    <h2>Built for real life</h2>
                    <p>Cooking shouldn't be complicated. These recipes come in under <span>30 minutes</span> of active time, fit busy schedules, and taste good enough to repeat. </p>
                    <p>Whether you're new to the kitchen or just need fresh ideas, we've got you covered.</p>
                </div>
                <div class="homepage-reallife__image animate-on-scroll animate-fade-in-up animate-delay-1">
                    <picture>
                        <source srcset="<?php echo e(asset('assets/images/image-home-real-life-large.webp')); ?>" media="(min-width: 640px)">
                        <img src="<?php echo e(asset('assets/images/image-home-real-life-small.webp')); ?>" alt="Person cooking in a kitchen" class="homepage-reallife__img" width="800" height="600">
                    </picture>
                </div>
            </div>
        </div>
    </section>

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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/pages/home.blade.php ENDPATH**/ ?>