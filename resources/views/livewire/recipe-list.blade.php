<div>
    <div class="recipes-intro wrapper animate-on-scroll animate-fade-in" wire:ignore.self>
        <h1 class="h2">Explore our simple, healthy recipes</h1>
        <p>Discover eight quick, whole-food dishes that fit real-life schedules and taste amazing. Use the search bar to find a recipe by name or ingredient, or simply scroll the list and let something delicious catch your eye.</p>
    </div>

    <div class="recipe-list wrapper">
        {{-- Filters Section --}}
        <form class="filters">
            @csrf

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

        </form>

        {{-- Recipe Grid --}}
        @if($recipes->count() > 0)
        <div class="grid recipe-list__grid" wire:transition>
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
            <button wire:click="clearFilters" class="btn">
                Clear Filters
            </button>
            @endif
        </div>
        @endif
    </div>
</div>