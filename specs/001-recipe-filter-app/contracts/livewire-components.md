# Livewire Component Contracts

**Date**: 2026-01-05  
**Branch**: `001-recipe-filter-app`

## Overview

This document defines the contracts for all Livewire components in the Recipe Filter Application. Since the application uses Laravel Livewire for reactive UI, there are no REST/GraphQL APIs. Instead, this document specifies the component properties, methods, events, and data flow.

---

## Component: RecipeList

**Location**: `app/Http/Livewire/RecipeList.php`  
**View**: `resources/views/livewire/recipe-list.blade.php`

### Purpose

Displays a paginated, filterable list of recipe cards with reactive updates based on filter changes.

### Public Properties

```php
public string $searchTerm = '';
public ?int $maxPrepTime = null;
public ?int $maxCookTime = null;
public int $perPage = 12;
```

### Computed Properties

```php
public function getRecipesProperty(): LengthAwarePaginator
{
    return Recipe::search($this->searchTerm)
        ->maxPrepTime($this->maxPrepTime)
        ->maxCookTime($this->maxCookTime)
        ->orderBy('title')
        ->paginate($this->perPage);
}
```

### Methods

**`mount()`**

```php
public function mount(): void
{
    // Initialize component state
    // Query params could be used to restore filter state
}
```

**`updatedSearchTerm()`**

```php
public function updatedSearchTerm(): void
{
    // Reset pagination when search changes
    $this->resetPage();
}
```

**`updatedMaxPrepTime()`**

```php
public function updatedMaxPrepTime(): void
{
    $this->resetPage();
}
```

**`updatedMaxCookTime()`**

```php
public function updatedMaxCookTime(): void
{
    $this->resetPage();
}
```

**`clearFilters()`**

```php
public function clearFilters(): void
{
    $this->searchTerm = '';
    $this->maxPrepTime = null;
    $this->maxCookTime = null;
    $this->resetPage();
}
```

### Listeners

```php
protected $listeners = [
    'filtersUpdated' => 'applyFilters',
];

public function applyFilters(array $filters): void
{
    $this->searchTerm = $filters['search'] ?? '';
    $this->maxPrepTime = $filters['maxPrepTime'] ?? null;
    $this->maxCookTime = $filters['maxCookTime'] ?? null;
    $this->resetPage();
}
```

### View Contract

**Blade Template** (`recipe-list.blade.php`):

```blade
<div>
    @if($recipes->count() > 0)
        <div class="recipe-grid">
            @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @endforeach
        </div>

        <div class="pagination">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="no-results">
            <p>No recipes found matching your criteria.</p>
            <button wire:click="clearFilters">Clear Filters</button>
        </div>
    @endif
</div>
```

### State Updates

| Trigger             | State Change                 | Result                                  |
| ------------------- | ---------------------------- | --------------------------------------- |
| Search input change | `searchTerm` updated         | Recipe list filters + resets pagination |
| Prep time change    | `maxPrepTime` updated        | Recipe list filters + resets pagination |
| Cook time change    | `maxCookTime` updated        | Recipe list filters + resets pagination |
| Clear filters       | All filters reset to default | Full recipe list displayed              |
| Page navigation     | Current page changes         | Next/previous page loaded               |

---

## Component: RecipeFilters

**Location**: `app/Http/Livewire/RecipeFilters.php`  
**View**: `resources/views/livewire/recipe-filters.blade.php`

### Purpose

Provides search and filter controls that emit filter changes to parent or sibling components.

### Public Properties

```php
public string $search = '';
public ?int $maxPrepTime = null;
public ?int $maxCookTime = null;
```

### Computed Properties

```php
public function getPrepTimeOptionsProperty(): array
{
    return [
        null => 'Any prep time',
        10 => '10 minutes or less',
        15 => '15 minutes or less',
        30 => '30 minutes or less',
        60 => '60 minutes or less',
    ];
}

public function getCookTimeOptionsProperty(): array
{
    return [
        null => 'Any cook time',
        10 => '10 minutes or less',
        15 => '15 minutes or less',
        30 => '30 minutes or less',
        45 => '45 minutes or less',
        60 => '60 minutes or less',
    ];
}
```

### Methods

**`mount()`**

```php
public function mount(): void
{
    // Initialize filter state from query params if needed
}
```

**`updatedSearch()`**

```php
public function updatedSearch(): void
{
    $this->emitFilters();
}
```

**`updatedMaxPrepTime()`**

```php
public function updatedMaxPrepTime(): void
{
    $this->emitFilters();
}
```

**`updatedMaxCookTime()`**

```php
public function updatedMaxCookTime(): void
{
    $this->emitFilters();
}
```

**`clearFilters()`**

```php
public function clearFilters(): void
{
    $this->search = '';
    $this->maxPrepTime = null;
    $this->maxCookTime = null;
    $this->emitFilters();
}
```

**`emitFilters()` (Private)**

```php
private function emitFilters(): void
{
    $this->dispatch('filtersUpdated', [
        'search' => $this->search,
        'maxPrepTime' => $this->maxPrepTime,
        'maxCookTime' => $this->maxCookTime,
    ]);
}
```

### Events Emitted

**`filtersUpdated`**

```php
// Payload
[
    'search' => string,
    'maxPrepTime' => int|null,
    'maxCookTime' => int|null,
]
```

### View Contract

**Blade Template** (`recipe-filters.blade.php`):

```blade
<div class="filters">
    <div class="filter__group">
        <label for="search" class="filter__label">Search</label>
        <input
            type="text"
            id="search"
            wire:model.debounce.300ms="search"
            placeholder="Recipe name or ingredient..."
            class="filter__input"
        >
    </div>

    <div class="filter__group">
        <label for="maxPrepTime" class="filter__label">Max Prep Time</label>
        <select
            id="maxPrepTime"
            wire:model.live="maxPrepTime"
            class="filter__select"
        >
            @foreach($this->prepTimeOptions as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter__group">
        <label for="maxCookTime" class="filter__label">Max Cook Time</label>
        <select
            id="maxCookTime"
            wire:model.live="maxCookTime"
            class="filter__select"
        >
            @foreach($this->cookTimeOptions as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button
        wire:click="clearFilters"
        class="filter__clear"
    >
        Clear Filters
    </button>
</div>
```

### Wire Directives

- `wire:model.debounce.300ms="search"`: 300ms debounce on search input
- `wire:model.live="maxPrepTime"`: Real-time update on prep time change
- `wire:model.live="maxCookTime"`: Real-time update on cook time change
- `wire:click="clearFilters"`: Clear button action

---

## Component: RecipeDetail

**Location**: `app/Http/Livewire/RecipeDetail.php`  
**View**: `resources/views/livewire/recipe-detail.blade.php`

### Purpose

Displays detailed information for a single recipe, including all ingredients, instructions, and related recipes.

### Public Properties

```php
public Recipe $recipe;
```

### Computed Properties

```php
public function getRelatedRecipesProperty(): Collection
{
    $count = min(3, Recipe::count() - 1);

    return Recipe::where('id', '!=', $this->recipe->id)
        ->inRandomOrder()
        ->limit($count)
        ->get();
}

public function getTotalTimeProperty(): int
{
    return $this->recipe->prep_minutes + $this->recipe->cook_minutes;
}
```

### Methods

**`mount(string $slug)`**

```php
public function mount(string $slug): void
{
    $this->recipe = Recipe::where('slug', $slug)->firstOrFail();
}
```

### View Contract

**Blade Template** (`recipe-detail.blade.php`):

```blade
<div class="recipe-detail">
    <div class="recipe-detail__header">
        <h1 class="recipe-detail__title">{{ $recipe->title }}</h1>
        <p class="recipe-detail__overview">{{ $recipe->overview }}</p>
    </div>

    <picture class="recipe-detail__image">
        <source
            media="(min-width: 768px)"
            srcset="{{ asset($recipe->image_large) }}"
        >
        <img
            src="{{ asset($recipe->image_small) }}"
            alt="{{ $recipe->title }}"
            loading="eager"
        >
    </picture>

    <div class="recipe-detail__meta">
        <div class="meta__item">
            <span class="meta__label">Servings</span>
            <span class="meta__value">{{ $recipe->servings }}</span>
        </div>
        <div class="meta__item">
            <span class="meta__label">Prep Time</span>
            <span class="meta__value">{{ $recipe->prep_minutes }} min</span>
        </div>
        <div class="meta__item">
            <span class="meta__label">Cook Time</span>
            <span class="meta__value">{{ $recipe->cook_minutes }} min</span>
        </div>
        <div class="meta__item">
            <span class="meta__label">Total Time</span>
            <span class="meta__value">{{ $this->totalTime }} min</span>
        </div>
    </div>

    <div class="recipe-detail__content">
        <section class="recipe-detail__section">
            <h2>Ingredients</h2>
            <ul class="ingredients-list">
                @foreach($recipe->ingredients as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach
            </ul>
        </section>

        <section class="recipe-detail__section">
            <h2>Instructions</h2>
            <ol class="instructions-list">
                @foreach($recipe->instructions as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </section>
    </div>

    @if($this->relatedRecipes->count() > 0)
        <section class="related-recipes">
            <h2>Related Recipes</h2>
            <div class="recipe-grid">
                @foreach($this->relatedRecipes as $relatedRecipe)
                    <x-recipe-card :recipe="$relatedRecipe" />
                @endforeach
            </div>
        </section>
    @endif
</div>
```

---

## Blade Component: RecipeCard

**Location**: `resources/views/components/recipe-card.blade.php`

### Purpose

Reusable recipe card component displayed in lists and related recipes sections.

### Props

```php
@props(['recipe'])
```

### Template Contract

```blade
<article class="recipe-card">
    <a href="{{ route('recipes.show', $recipe->slug) }}" class="recipe-card__link">
        <picture class="recipe-card__image">
            <img
                src="{{ asset($recipe->image_small) }}"
                alt="{{ $recipe->title }}"
                loading="lazy"
                width="400"
                height="300"
            >
        </picture>

        <div class="recipe-card__content">
            <h3 class="recipe-card__title">{{ $recipe->title }}</h3>
            <p class="recipe-card__description">{{ $recipe->overview }}</p>

            <div class="recipe-card__meta">
                <span class="meta__item">
                    <svg class="meta__icon"><!-- servings icon --></svg>
                    {{ $recipe->servings }} servings
                </span>
                <span class="meta__item">
                    <svg class="meta__icon"><!-- clock icon --></svg>
                    {{ $recipe->prep_minutes }} min prep
                </span>
                <span class="meta__item">
                    <svg class="meta__icon"><!-- clock icon --></svg>
                    {{ $recipe->cook_minutes }} min cook
                </span>
                <span class="meta__item">
                    <svg class="meta__icon"><!-- list icon --></svg>
                    {{ $recipe->ingredient_count }} ingredients
                </span>
            </div>

            <button class="recipe-card__button">View Recipe</button>
        </div>
    </a>
</article>
```

---

## Component Communication Flow

```
┌─────────────────────┐
│  RecipeFilters      │
│  - search           │
│  - maxPrepTime      │
│  - maxCookTime      │
└──────────┬──────────┘
           │
           │ emits: filtersUpdated
           │ payload: { search, maxPrepTime, maxCookTime }
           ▼
┌─────────────────────┐
│  RecipeList         │
│  - searchTerm       │
│  - maxPrepTime      │
│  - maxCookTime      │
│                     │
│  queries: Recipe    │
│  with filters       │
└──────────┬──────────┘
           │
           │ renders multiple
           ▼
┌─────────────────────┐
│  RecipeCard         │
│  (Blade Component)  │
└─────────────────────┘
```

**Alternative Flow** (integrated filters in RecipeList):

```
┌─────────────────────────────────┐
│  RecipeList                     │
│  - searchTerm (wire:model)      │
│  - maxPrepTime (wire:model)     │
│  - maxCookTime (wire:model)     │
│                                 │
│  includes filter controls       │
│  in same component              │
└──────────┬──────────────────────┘
           │
           │ renders multiple
           ▼
┌─────────────────────┐
│  RecipeCard         │
│  (Blade Component)  │
└─────────────────────┘
```

**Recommendation**: Use integrated approach (single RecipeList component) for simplicity. Separate RecipeFilters component only if filters need to persist across navigation or be reused elsewhere.

---

## Route Contracts

**Web Routes** (`routes/web.php`):

```php
use App\Http\Livewire\RecipeList;
use App\Http\Livewire\RecipeDetail;
use Illuminate\Support\Facades\Route;

// Static pages
Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');

// Recipe pages
Route::get('/recipes', RecipeList::class)->name('recipes.index');
Route::get('/recipes/{slug}', RecipeDetail::class)->name('recipes.show');
```

### Route Parameters

**`/recipes`**

- **Method**: GET
- **Component**: RecipeList
- **Query Params** (optional):
  - `search`: string
  - `prep`: integer (max prep time)
  - `cook`: integer (max cook time)
  - `page`: integer (pagination)

**`/recipes/{slug}`**

- **Method**: GET
- **Component**: RecipeDetail
- **Path Params**:
  - `slug`: string (recipe slug, e.g., "mediterranean-chickpea-salad")

---

## Data Transfer Objects (DTOs)

### RecipeCardData

Used for consistent recipe card rendering across list and detail views:

```php
namespace App\DataTransferObjects;

class RecipeCardData
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $slug,
        public readonly string $overview,
        public readonly int $servings,
        public readonly int $prepMinutes,
        public readonly int $cookMinutes,
        public readonly string $imageSmall,
        public readonly int $ingredientCount,
    ) {}

    public static function fromModel(Recipe $recipe): self
    {
        return new self(
            id: $recipe->id,
            title: $recipe->title,
            slug: $recipe->slug,
            overview: $recipe->overview,
            servings: $recipe->servings,
            prepMinutes: $recipe->prep_minutes,
            cookMinutes: $recipe->cook_minutes,
            imageSmall: $recipe->image_small,
            ingredientCount: $recipe->ingredient_count,
        );
    }
}
```

**Note**: DTOs are optional for MVP. Direct model usage is acceptable given simple structure.

---

## Error Handling

### 404 - Recipe Not Found

**Trigger**: User navigates to `/recipes/{invalid-slug}`

**Handling**:

```php
// In RecipeDetail component mount()
public function mount(string $slug): void
{
    try {
        $this->recipe = Recipe::where('slug', $slug)->firstOrFail();
    } catch (ModelNotFoundException $e) {
        abort(404, 'Recipe not found');
    }
}
```

**View**: Laravel default 404 page or custom `resources/views/errors/404.blade.php`

### No Search Results

**Trigger**: Filters return empty result set

**Handling**: Display message in RecipeList view (see View Contract above)

### Component Property Validation

Livewire automatically validates property types. Additional validation:

```php
// In RecipeFilters component
protected function rules(): array
{
    return [
        'search' => 'nullable|string|max:255',
        'maxPrepTime' => 'nullable|integer|min:0|max:1440',
        'maxCookTime' => 'nullable|integer|min:0|max:1440',
    ];
}

public function updatedMaxPrepTime($value): void
{
    $this->validateOnly('maxPrepTime');
    $this->emitFilters();
}
```

---

## Performance Considerations

### Query Optimization

- **Indexes**: Ensure indexes on `prep_minutes`, `cook_minutes`, `slug`
- **Pagination**: Limit to 12 items per page
- **Eager Loading**: Not needed (no relationships in MVP)
- **Query Caching**: Consider for static recipe list on homepage

### Livewire Optimizations

- **Debouncing**: 300ms on search input (`wire:model.debounce.300ms`)
- **Lazy Loading**: Use `wire:init` for related recipes if needed
- **Polling**: Not required (no real-time updates)
- **Lazy Components**: Not needed for this scale

### View Transitions

```javascript
// resources/js/app.js
document.addEventListener("livewire:navigated", () => {
  if ("startViewTransition" in document) {
    document.startViewTransition(() => {
      // DOM updates handled by Livewire
    });
  }
});
```

---

## Testing Contracts (Manual)

Since the constitution specifies no automated testing, manual test scenarios:

### RecipeList Component

1. **Default State**: Navigate to `/recipes`, verify all recipes displayed
2. **Search**: Type "chickpea", verify only matching recipes shown
3. **Prep Filter**: Select "15 minutes or less", verify results
4. **Cook Filter**: Select "30 minutes or less", verify results
5. **Combined Filters**: Apply search + prep + cook, verify results
6. **Clear Filters**: Click clear button, verify all filters reset
7. **Pagination**: Navigate to page 2, verify different recipes
8. **No Results**: Search "xyz123", verify "no results" message

### RecipeDetail Component

1. **Valid Recipe**: Navigate to `/recipes/mediterranean-chickpea-salad`, verify full content
2. **Invalid Recipe**: Navigate to `/recipes/invalid-slug`, verify 404 page
3. **Related Recipes**: Verify 3 or fewer related recipes shown
4. **Image Loading**: Verify large image on desktop, small on mobile

### RecipeFilters Component

1. **Search Input**: Type with 300ms debounce, verify delay
2. **Dropdown Change**: Change prep time, verify immediate update
3. **Clear Button**: Verify all inputs reset

---

## Contract Summary

| Component         | Properties                       | Methods                    | Events Emitted | Route           |
| ----------------- | -------------------------------- | -------------------------- | -------------- | --------------- |
| **RecipeList**    | search, maxPrepTime, maxCookTime | clearFilters, applyFilters | None           | /recipes        |
| **RecipeFilters** | search, maxPrepTime, maxCookTime | clearFilters, emitFilters  | filtersUpdated | (embedded)      |
| **RecipeDetail**  | recipe                           | None                       | None           | /recipes/{slug} |
| **RecipeCard**    | recipe (prop)                    | None                       | None           | (component)     |

**Contracts Complete**: All component interfaces documented and ready for implementation.
