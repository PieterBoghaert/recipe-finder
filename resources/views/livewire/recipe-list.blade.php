<div class="recipe-list">
    {{-- Filters Section --}}
    <div class="filters">
        <div class="filters__group">
            <label for="search" class="filters__label">Search</label>
            <input
                type="search"
                id="search"
                wire:model.live.debounce.300ms="searchTerm"
                placeholder="Search recipes or ingredients..."
                class="filters__input">
        </div>

        <div class="filters__group">
            <label for="maxPrepTime" class="filters__label">Max Prep Time</label>
            <select wire:model.live="maxPrepTime" id="maxPrepTime" class="filters__select">
                <option value="">All times</option>
                <option value="10">10 min</option>
                <option value="15">15 min</option>
                <option value="30">30 min</option>
                <option value="45">45 min</option>
                <option value="60">1 hour</option>
            </select>
        </div>

        <div class="filters__group">
            <label for="maxCookTime" class="filters__label">Max Cook Time</label>
            <select wire:model.live="maxCookTime" id="maxCookTime" class="filters__select">
                <option value="">All times</option>
                <option value="10">10 min</option>
                <option value="15">15 min</option>
                <option value="30">30 min</option>
                <option value="45">45 min</option>
                <option value="60">1 hour</option>
            </select>
        </div>

        @if($searchTerm || $maxPrepTime || $maxCookTime)
        <div class="filters__actions">
            <button wire:click="clearFilters" class="button button--outline button--sm filters__clear">
                Clear Filters
            </button>
        </div>
        @endif
    </div>

    {{-- Recipe Grid --}}
    @if($recipes->count() > 0)
    <div class="grid grid--cols-3 recipe-list__grid">
        @foreach($recipes as $recipe)
        <x-recipe-card :recipe="$recipe" />
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="recipe-list__pagination">
        {{ $recipes->links() }}
    </div>
    @else
    <div class="recipe-list__empty">
        <h3>No recipes found</h3>
        <p>Try adjusting your filters or search term.</p>
        @if($searchTerm || $maxPrepTime || $maxCookTime)
        <button wire:click="clearFilters" class="navigation__button">
            Clear Filters
        </button>
        @endif
    </div>
    @endif
</div>