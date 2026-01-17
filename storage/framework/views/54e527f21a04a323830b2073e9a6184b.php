<div>
    <div class="recipes-intro wrapper animate-on-scroll animate-fade-in" wire:ignore.self>
        <h1 class="h2">Explore our simple, healthy recipes</h1>
        <p>Discover eight quick, whole-food dishes that fit real-life schedules and taste amazing. Use the search bar to find a recipe by name or ingredient, or simply scroll the list and let something delicious catch your eye.</p>
    </div>

    <div class="recipe-list wrapper">
        
        <div class="filters">


            <div class="filters__group">
                <label for="maxPrepTime" class="filters__label sr-only">Max Prep Time</label>
                <select wire:model.live="maxPrepTime" id="maxPrepTime" class="filters__select filters__select--custom">
                    <option value="">Max Prep Time</option>
                    <option value="0">
                        0 minutes
                    </option>
                    <option value="5">
                        5 minutes
                    </option>
                    <option value="10">
                        10 minutes
                    </option>
                    <option value="clear" onclick="event.preventDefault(); const select = this.parentElement; select.value = ''; select.dispatchEvent(new Event('change', { bubbles: true }));">
                        Clear
                    </option>
                </select>
            </div>

            <div class="filters__group">
                <label for="maxCookTime" class="filters__label sr-only">Max Cook Time</label>
                <select wire:model.live="maxCookTime" id="maxCookTime" class="filters__select filters__select--custom">
                    <option value="">Max Cook Time</option>
                    <option value="0">
                        0 minutes
                    </option>
                    <option value="5">
                        5 minutes
                    </option>
                    <option value="10">
                        10 minutes
                    </option>
                    <option value="15">
                        15 minutes
                    </option>
                    <option value="20">
                        20 minutes
                    </option>
                    <option value="clear" onclick="event.preventDefault(); const select = this.parentElement; select.value = ''; select.dispatchEvent(new Event('change', { bubbles: true }));">
                        Clear
                    </option>
                </select>
            </div>

            <div class="filters__group filters__group--search">
                <label for="search" class="filters__label sr-only">Search</label>
                <input
                    type="search"
                    id="search"
                    wire:model.live.debounce.300ms="searchTerm"
                    placeholder="Search by name or ingredient..."
                    class="filters__input">
            </div>

        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recipes->count() > 0): ?>
        <div class="grid recipe-list__grid" wire:transition>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal9ff93d1775529871158937c5c88e7f2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ff93d1775529871158937c5c88e7f2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.recipe-card','data' => ['recipe' => $recipe]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('recipe-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['recipe' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recipe)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div class="recipe-list__pagination">
            <?php echo e($recipes->links()); ?>

        </div>
        <?php else: ?>
        <div class="recipe-list__empty">
            <h3>No recipes found</h3>
            <p>Try adjusting your filters or search term.</p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($searchTerm || $maxPrepTime || $maxCookTime): ?>
            <button wire:click="clearFilters" class="btn">
                Clear Filters
            </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/livewire/recipe-list.blade.php ENDPATH**/ ?>