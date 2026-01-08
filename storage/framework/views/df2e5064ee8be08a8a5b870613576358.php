<div class="recipe-detail">
    
    <div class="recipe-detail__breadcrumb">
        <a href="<?php echo e(route('recipes')); ?>" wire:navigate>Recipes</a>
        <span> / </span>
        <span><?php echo e($recipe->title); ?></span>
    </div>

    
    <div class="recipe-detail__header">
        <picture class="recipe-detail__image-wrapper">
            <source srcset="<?php echo e(asset($recipe->image_large)); ?>" media="(min-width: 640px)">
            <img
                src="<?php echo e(asset($recipe->image_small)); ?>"
                alt="<?php echo e($recipe->title); ?>"
                class="recipe-detail__image"
                style="view-transition-name: recipe-image-<?php echo e($recipe->slug); ?>;">
        </picture>

        <div class="recipe-detail__header-content">
            <h1 class="recipe-detail__title h2"><?php echo e($recipe->title); ?></h1>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recipe->overview): ?>
            <p class="recipe-detail__overview"><?php echo e($recipe->overview); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="recipe-detail__meta">
                <div class="recipe-detail__meta-item">
                    <img src="<?php echo e(asset('assets/images/icon-servings.svg')); ?>" alt="Servings Icon" aria-hidden="true">
                    <span>Servings: <?php echo e($recipe->servings); ?></span>
                </div>
                <div class="recipe-detail__meta-item">
                    <img src="<?php echo e(asset('assets/images/icon-prep-time.svg')); ?>" alt="Prep Time Icon" aria-hidden="true">
                    <span>Preps: <?php echo e($recipe->prep_minutes); ?> min</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <img src="<?php echo e(asset('assets/images/icon-cook-time.svg')); ?>" alt="Cook Time Icon" aria-hidden="true">
                    <span>Cook: <?php echo e($recipe->cook_minutes); ?> min</span>
                </div>
            </div>

            
            <div class="recipe-detail__section">
                <h4 class="recipe-detail__section-title">Ingredients:</h4>
                <ul class="recipe-detail__ingredients">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="recipe-detail__ingredient"><?php echo e($ingredient); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            
            <div class="recipe-detail__section">
                <h4 class="recipe-detail__section-title">Instructions:</h4>
                <ul class="recipe-detail__instructions">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recipe->instructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $instruction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="recipe-detail__instruction">
                        <span class="recipe-detail__step-number"><?php echo e($index + 1); ?></span>
                        <span class="recipe-detail__step-text"><?php echo e($instruction); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedRecipes->count() > 0): ?>
    <div class="recipe-detail__related">
        <h3 class="recipe-detail__related-title">More recipes</h3>
        <div class="grid grid--cols-3 recipe-detail__related-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedRecipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedRecipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal9ff93d1775529871158937c5c88e7f2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ff93d1775529871158937c5c88e7f2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.recipe-card','data' => ['recipe' => $relatedRecipe]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('recipe-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['recipe' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($relatedRecipe)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ff93d1775529871158937c5c88e7f2b)): ?>
<?php $attributes = $__attributesOriginal9ff93d1775529871158937c5c88e7f2b; ?>
<?php unset($__attributesOriginal9ff93d1775529871158937c5c88e7f2b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ff93d1775529871158937c5c88e7f2b)): ?>
<?php $component = $__componentOriginal9ff93d1775529871158937c5c88e7f2b; ?>
<?php unset($__componentOriginal9ff93d1775529871158937c5c88e7f2b); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/livewire/recipe-detail.blade.php ENDPATH**/ ?>