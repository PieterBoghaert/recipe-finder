@props(['recipe'])

<article class="recipe-card">
    <a href="{{ route('recipe.show', $recipe->slug) }}" class="recipe-card__link">
        {{-- Recipe Image --}}
        <div class="recipe-card__image-wrapper">
            <picture>
                <source srcset="{{ asset($recipe->image_small) }}" media="(max-width: 640px)">
                <img
                    src="{{ asset($recipe->image_large) }}"
                    alt="{{ $recipe->title }}"
                    class="recipe-card__image"
                    loading="lazy">
            </picture>
        </div>

        {{-- Recipe Content --}}
        <div class="recipe-card__content">
            <h3 class="recipe-card__title">{{ $recipe->title }}</h3>

            @if($recipe->overview)
            <p class="recipe-card__description">{{ Str::limit($recipe->overview, 100) }}</p>
            @endif

            {{-- Recipe Meta --}}
            <div class="recipe-card__meta">
                <span class="recipe-card__meta-item">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    {{ $recipe->servings }} servings
                </span>
                <span class="recipe-card__meta-item">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                    </svg>
                    Prep: {{ $recipe->prep_minutes }}m
                </span>
                <span class="recipe-card__meta-item">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                    </svg>
                    Cook: {{ $recipe->cook_minutes }}m
                </span>
                <span class="recipe-card__meta-item">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                    </svg>
                    {{ $recipe->ingredient_count }} ingredients
                </span>
            </div>

            {{-- View Recipe Button --}}
            <span class="recipe-card__button">View Recipe</span>
        </div>
    </a>
</article>