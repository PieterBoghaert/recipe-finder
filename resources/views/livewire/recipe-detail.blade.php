<div class="recipe-detail">
    {{-- Breadcrumb --}}
    <div class="recipe-detail__breadcrumb">
        <a href="{{ route('recipes') }}" wire:navigate>Recipes</a>
        <span> / </span>
        <span>{{ $recipe->title }}</span>
    </div>

    {{-- Recipe Header --}}
    <div class="recipe-detail__header">
        <picture class="recipe-detail__image-wrapper">
            <source srcset="{{ asset($recipe->image_large) }}" media="(min-width: 640px)">
            <img
                src="{{ asset($recipe->image_small) }}"
                alt="{{ $recipe->title }}"
                class="recipe-detail__image"
                style="view-transition-name: recipe-image-{{ $recipe->slug }};">
        </picture>

        <div class="recipe-detail__header-content">
            <h1 class="recipe-detail__title h2">{{ $recipe->title }}</h1>

            @if($recipe->overview)
            <p class="recipe-detail__overview">{{ $recipe->overview }}</p>
            @endif

            {{-- Recipe Meta --}}
            <div class="recipe-detail__meta">
                <div class="recipe-detail__meta-item">
                    <img src="{{ asset('assets/images/icon-servings.svg') }}" alt="Servings Icon" aria-hidden="true">
                    <span>Servings: {{ $recipe->servings }}</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <img src="{{ asset('assets/images/icon-prep-time.svg') }}" alt="Prep Time Icon" aria-hidden="true">
                    <span>Preps: {{ $recipe->prep_minutes }} min</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <img src="{{ asset('assets/images/icon-cook-time.svg') }}" alt="Cook Time Icon" aria-hidden="true">
                    <span>Cook: {{ $recipe->cook_minutes }} min</span>
                </div>
            </div>

            {{-- Ingredients Section --}}
            <div class="recipe-detail__section">
                <h4 class="recipe-detail__section-title">Ingredients:</h4>
                <ul class="recipe-detail__ingredients">
                    @foreach($recipe->ingredients as $ingredient)
                    <li class="recipe-detail__ingredient">{{ $ingredient }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Instructions Section --}}
            <div class="recipe-detail__section">
                <h4 class="recipe-detail__section-title">Instructions:</h4>
                <ul class="recipe-detail__instructions">
                    @foreach($recipe->instructions as $index => $instruction)
                    <li class="recipe-detail__instruction">
                        <span class="recipe-detail__step-number">{{ $index + 1 }}</span>
                        <span class="recipe-detail__step-text">{{ $instruction }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Related Recipes --}}
    @if($relatedRecipes->count() > 0)
    <div class="recipe-detail__related">
        <h3 class="recipe-detail__related-title">More recipes</h3>
        <div class="grid grid--cols-3 recipe-detail__related-grid">
            @foreach($relatedRecipes as $relatedRecipe)
            <x-recipe-card :recipe="$relatedRecipe" />
            @endforeach
        </div>
    </div>
    @endif
</div>