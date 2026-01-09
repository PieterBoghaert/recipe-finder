@props(['recipe'])

<article class="recipe-card">
    <a href="{{ route('recipe.show', $recipe->slug) }}" class="recipe-card__link" wire:navigate>
        {{-- Recipe Image --}}
        <div class="recipe-card__image-wrapper">
            <picture>
                <source srcset="{{ asset($recipe->image_small) }}" media="(max-width: 640px)">
                <img
                    src="{{ asset($recipe->image_large) }}"
                    alt="{{ $recipe->title }}"
                    class="recipe-card__image"
                    style="view-transition-name: recipe-image-{{ $recipe->slug }};"
                    width="1024"
                    height="1024"
                    loading="lazy">
            </picture>
        </div>

        {{-- Recipe Content --}}
        <div class="recipe-card__content">
            <h5 class="recipe-card__title">{{ $recipe->title }}</h5>

            @if($recipe->overview)
            <p class="recipe-card__description">{{ Str::limit($recipe->overview, 100) }}</p>
            @endif

            {{-- Recipe Meta --}}
            <div class="recipe-card__meta">
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="{{ asset('assets/images/icon-servings.svg') }}" alt="Servings Icon" />
                    {{ $recipe->servings }} servings
                </span>
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="{{ asset('assets/images/icon-prep-time.svg') }}" alt="Prep Time Icon" />
                    Prep: {{ $recipe->prep_minutes }}m
                </span>
                <span class="recipe-card__meta-item">
                    <img width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" src="{{ asset('assets/images/icon-cook-time.svg') }}" alt="Cook Time Icon" />
                    Cook: {{ $recipe->cook_minutes }}m
                </span>

            </div>
        </div>
        {{-- View Recipe Button --}}
        <span class="recipe-card__button btn btn--full">View Recipe</span>
    </a>
</article>