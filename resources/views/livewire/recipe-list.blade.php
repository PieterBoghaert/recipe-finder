<div class="recipe-list wrapper">
    {{-- Filters Section --}}
    <div class="filters">


        <div class="filters__group">
            <label for="maxPrepTime" class="filters__label sr-only">Max Prep Time</label>
            <select wire:model.live="maxPrepTime" id="maxPrepTime" class="filters__select">
                <option value="-1">Max Prep Time</option>
                <option value="0">0 minutes</option>
                <option value="5">5 minutes</option>
                <option value="10">10 minutes</option>
            </select>
        </div>

        <div class="filters__group">
            <label for="maxCookTime" class="filters__label sr-only">Max Cook Time</label>
            <select wire:model.live="maxCookTime" id="maxCookTime" class="filters__select">
                <option value="-1">Max Cook Time</option>
                <option value="0">0 minutes</option>
                <option value="5">5 minutes</option>
                <option value="10">10 minutes</option>
                <option value="15">15 minutes</option>
                <option value="20">20 minutes</option>
            </select>
        </div>

        <div class="filters__group filters__group--search">
            <label for="search" class="filters__label sr-only">Search</label>
            <input
                type="search"
                id="search"
                wire:model.live.debounce.300ms="searchTerm"
                placeholder="Search recipes or ingredients..."
                class="filters__input">
        </div>


    </div>

    {{-- Recipe Grid --}}
    @if($recipes->count() > 0)
    <div class="grid recipe-list__grid">
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