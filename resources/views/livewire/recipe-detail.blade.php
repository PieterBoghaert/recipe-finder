<div class="recipe-detail">
    {{-- Recipe Header --}}
    <div class="recipe-detail__header">
        <div class="recipe-detail__image-wrapper">
            <img 
                src="{{ asset($recipe->image_large) }}" 
                alt="{{ $recipe->title }}"
                class="recipe-detail__image"
            >
        </div>
        
        <div class="recipe-detail__header-content">
            <h1 class="recipe-detail__title">{{ $recipe->title }}</h1>
            
            @if($recipe->overview)
                <p class="recipe-detail__overview">{{ $recipe->overview }}</p>
            @endif

            {{-- Recipe Meta --}}
            <div class="recipe-detail__meta">
                <div class="recipe-detail__meta-item">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <span><strong>Servings:</strong> {{ $recipe->servings }}</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <span><strong>Prep Time:</strong> {{ $recipe->prep_minutes }} min</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <span><strong>Cook Time:</strong> {{ $recipe->cook_minutes }} min</span>
                </div>
                <div class="recipe-detail__meta-item">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    <span><strong>Total Time:</strong> {{ $recipe->total_minutes }} min</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Recipe Content --}}
    <div class="recipe-detail__content">
        {{-- Ingredients Section --}}
        <div class="recipe-detail__section">
            <h2 class="recipe-detail__section-title">Ingredients</h2>
            <ul class="recipe-detail__ingredients">
                @foreach($recipe->ingredients as $ingredient)
                    <li class="recipe-detail__ingredient">{{ $ingredient }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Instructions Section --}}
        <div class="recipe-detail__section">
            <h2 class="recipe-detail__section-title">Instructions</h2>
            <ol class="recipe-detail__instructions">
                @foreach($recipe->instructions as $index => $instruction)
                    <li class="recipe-detail__instruction">
                        <span class="recipe-detail__step-number">{{ $index + 1 }}</span>
                        <span class="recipe-detail__step-text">{{ $instruction }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{-- Related Recipes --}}
    @if($relatedRecipes->count() > 0)
        <div class="recipe-detail__related">
            <h2 class="recipe-detail__related-title">You Might Also Like</h2>
            <div class="grid grid--cols-3 recipe-detail__related-grid">
                @foreach($relatedRecipes as $relatedRecipe)
                    <x-recipe-card :recipe="$relatedRecipe" />
                @endforeach
            </div>
        </div>
    @endif
</div>
