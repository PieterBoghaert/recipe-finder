# Data Model: Recipe Filter Application

**Date**: 2026-01-05  
**Branch**: `001-recipe-filter-app`

## Overview

This document defines the data entities, their attributes, relationships, and validation rules for the Recipe Filter Application. The model is designed for Laravel Eloquent ORM with PostgreSQL/MySQL (production) and SQLite (development).

---

## Entity: Recipe

### Description

Represents a cooking recipe with all necessary information for display, filtering, and search.

### Database Table: `recipes`

| Column         | Type             | Constraints                         | Description                              |
| -------------- | ---------------- | ----------------------------------- | ---------------------------------------- |
| `id`           | BIGINT UNSIGNED  | PRIMARY KEY, AUTO_INCREMENT         | Unique recipe identifier                 |
| `title`        | VARCHAR(255)     | NOT NULL                            | Recipe name                              |
| `slug`         | VARCHAR(255)     | NOT NULL, UNIQUE, INDEX             | URL-friendly identifier                  |
| `overview`     | TEXT             | NULLABLE                            | Brief recipe description                 |
| `servings`     | INTEGER UNSIGNED | NOT NULL, DEFAULT 1                 | Number of servings                       |
| `prep_minutes` | INTEGER UNSIGNED | NOT NULL, INDEX                     | Preparation time in minutes              |
| `cook_minutes` | INTEGER UNSIGNED | NOT NULL, INDEX                     | Cooking time in minutes                  |
| `image_large`  | VARCHAR(512)     | NOT NULL                            | Path to large image (for detail/desktop) |
| `image_small`  | VARCHAR(512)     | NOT NULL                            | Path to small image (for cards/mobile)   |
| `ingredients`  | JSON             | NOT NULL                            | Array of ingredient strings              |
| `instructions` | JSON             | NOT NULL                            | Array of instruction step strings        |
| `created_at`   | TIMESTAMP        | NOT NULL, DEFAULT CURRENT_TIMESTAMP | Record creation timestamp                |
| `updated_at`   | TIMESTAMP        | NOT NULL, DEFAULT CURRENT_TIMESTAMP | Record last update timestamp             |

### Indexes

```sql
-- Primary index
PRIMARY KEY (id)

-- Unique constraint for slug
UNIQUE INDEX idx_recipes_slug (slug)

-- Filter optimization
INDEX idx_recipes_prep_minutes (prep_minutes)
INDEX idx_recipes_cook_minutes (cook_minutes)

-- Full-text search (MySQL/PostgreSQL)
FULLTEXT INDEX idx_recipes_search (title)
-- Note: JSON ingredient search handled via JSON_CONTAINS (MySQL) or jsonb @> (PostgreSQL)
```

### Laravel Migration

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('overview')->nullable();
            $table->unsignedInteger('servings')->default(1);
            $table->unsignedInteger('prep_minutes');
            $table->unsignedInteger('cook_minutes');
            $table->string('image_large', 512);
            $table->string('image_small', 512);
            $table->json('ingredients');
            $table->json('instructions');
            $table->timestamps();

            // Indexes
            $table->index('slug');
            $table->index('prep_minutes');
            $table->index('cook_minutes');

            // Full-text index (MySQL)
            if (DB::connection()->getDriverName() === 'mysql') {
                DB::statement('ALTER TABLE recipes ADD FULLTEXT idx_recipes_search (title)');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
```

### Eloquent Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'overview',
        'servings',
        'prep_minutes',
        'cook_minutes',
        'image_large',
        'image_small',
        'ingredients',
        'instructions',
    ];

    protected $casts = [
        'servings' => 'integer',
        'prep_minutes' => 'integer',
        'cook_minutes' => 'integer',
        'ingredients' => 'array',
        'instructions' => 'array',
    ];

    // Computed attributes
    public function totalMinutes(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->prep_minutes + $this->cook_minutes,
        );
    }

    public function ingredientCount(): Attribute
    {
        return Attribute::make(
            get: fn () => count($this->ingredients),
        );
    }

    // Scopes for filtering
    public function scopeSearch($query, ?string $term)
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'LIKE', "%{$term}%")
              ->orWhereJsonContains('ingredients', $term);
        });
    }

    public function scopeMaxPrepTime($query, ?int $minutes)
    {
        if (is_null($minutes)) {
            return $query;
        }

        return $query->where('prep_minutes', '<=', $minutes);
    }

    public function scopeMaxCookTime($query, ?int $minutes)
    {
        if (is_null($minutes)) {
            return $query;
        }

        return $query->where('cook_minutes', '<=', $minutes);
    }

    public function scopeExcludeId($query, int $id)
    {
        return $query->where('id', '!=', $id);
    }

    public function scopeRandomRelated($query, int $excludeId, int $limit = 3)
    {
        return $query->excludeId($excludeId)
            ->inRandomOrder()
            ->limit($limit);
    }
}
```

### Validation Rules

**Create/Update Recipe**:

```php
[
    'title' => 'required|string|max:255',
    'slug' => 'required|string|max:255|unique:recipes,slug',
    'overview' => 'nullable|string|max:1000',
    'servings' => 'required|integer|min:1|max:50',
    'prep_minutes' => 'required|integer|min:0|max:1440', // Max 24 hours
    'cook_minutes' => 'required|integer|min:0|max:1440',
    'image_large' => 'required|string|max:512',
    'image_small' => 'required|string|max:512',
    'ingredients' => 'required|array|min:1',
    'ingredients.*' => 'required|string|max:500',
    'instructions' => 'required|array|min:1',
    'instructions.*' => 'required|string|max:2000',
]
```

### Business Rules

1. **Unique Slug**: Each recipe must have a unique slug for URL routing
2. **Positive Time**: Prep and cook minutes must be non-negative
3. **Minimum Content**: At least 1 ingredient and 1 instruction step required
4. **Image Paths**: Must reference valid files in public storage
5. **Servings Range**: 1-50 servings (reasonable range for home cooking)

### State Transitions

_Not applicable - recipes do not have state transitions in MVP. All recipes are published/active._

### Data Seeding

**RecipeSeeder** imports data from `starter-code/data.json`:

```php
<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('starter-code/data.json');

        if (!File::exists($jsonPath)) {
            $this->command->error('data.json not found at: ' . $jsonPath);
            return;
        }

        $json = File::get($jsonPath);
        $recipes = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Invalid JSON in data.json');
            return;
        }

        foreach ($recipes as $recipeData) {
            Recipe::create([
                'title' => $recipeData['title'],
                'slug' => $recipeData['slug'],
                'overview' => $recipeData['overview'] ?? null,
                'servings' => $recipeData['servings'],
                'prep_minutes' => $recipeData['prepMinutes'],
                'cook_minutes' => $recipeData['cookMinutes'],
                'image_large' => $recipeData['image']['large'],
                'image_small' => $recipeData['image']['small'],
                'ingredients' => $recipeData['ingredients'],
                'instructions' => $recipeData['instructions'],
            ]);
        }

        $this->command->info('Successfully seeded ' . count($recipes) . ' recipes');
    }
}
```

---

## Entity Relationships

### Current State (MVP)

- **Recipe**: Standalone entity with no relationships
- **Related Recipes**: Dynamic query (not a formal relationship)

### Future Expansion (Post-MVP)

Potential relationships for future features:

```
Recipe (1) ──────────── (*) RecipeCategory
          └── has many ───→ Category

Recipe (1) ──────────── (*) UserFavorite
          └── belongs to ──→ User

Recipe (1) ──────────── (*) Rating
          └── has many ───→ User
```

---

## Query Patterns

### Common Queries

**1. List All Recipes (Paginated)**

```php
Recipe::orderBy('title')
    ->paginate(12);
```

**2. Filter by Search + Time Constraints**

```php
Recipe::search($searchTerm)
    ->maxPrepTime($maxPrepMinutes)
    ->maxCookTime($maxCookMinutes)
    ->orderBy('title')
    ->paginate(12);
```

**3. Get Single Recipe by Slug**

```php
Recipe::where('slug', $slug)
    ->firstOrFail();
```

**4. Get Random Related Recipes**

```php
Recipe::randomRelated($currentRecipeId, 3)
    ->get();
```

**5. Search by Ingredient**

```php
// MySQL
Recipe::whereRaw('JSON_SEARCH(ingredients, "one", ?) IS NOT NULL', ["%{$ingredient}%"])
    ->get();

// PostgreSQL
Recipe::whereRaw('ingredients::jsonb @> ?', [json_encode([$ingredient])])
    ->get();
```

### Performance Considerations

- **Indexes**: `prep_minutes` and `cook_minutes` indexes enable fast range queries
- **JSON Search**: PostgreSQL `jsonb` type provides better JSON query performance than MySQL
- **Pagination**: Limit results to 12-24 per page to avoid large result sets
- **Eager Loading**: Not applicable (no relationships in MVP)
- **Caching**: Consider caching recipe list for homepage (low update frequency)

---

## Data Volume Estimates

| Metric                      | MVP       | Year 1 Projection |
| --------------------------- | --------- | ----------------- |
| **Total Recipes**           | ~50       | 200-500           |
| **Avg Ingredients/Recipe**  | 8         | 8                 |
| **Avg Instructions/Recipe** | 4-6 steps | 4-6 steps         |
| **Avg Recipe Size**         | ~2 KB     | ~2 KB             |
| **Total DB Size**           | ~100 KB   | ~1 MB             |
| **Image Storage**           | ~50 MB    | ~200 MB           |

**Conclusion**: Data volume is minimal. Standard database and storage configurations are sufficient.

---

## Data Integrity & Constraints

### Referential Integrity

- No foreign keys in MVP (standalone entity)
- Slug uniqueness enforced at database level

### Data Validation

- Laravel model validation on create/update
- UNSIGNED integers prevent negative values
- JSON casting ensures array type for ingredients/instructions

### Error Handling

**Missing Recipe**:

```php
try {
    $recipe = Recipe::where('slug', $slug)->firstOrFail();
} catch (ModelNotFoundException $e) {
    abort(404, 'Recipe not found');
}
```

**Invalid Filter Values**:

- Livewire validates input types
- Null/empty filters default to "no filter" (show all)

**Missing Images**:

- CSS fallback background color
- Alt text describes expected content
- Consider adding image validation in seeder

---

## Sample Data Structure

### Example Recipe Record (JSON representation)

```json
{
  "id": 1,
  "title": "Mediterranean Chickpea Salad",
  "slug": "mediterranean-chickpea-salad",
  "overview": "A refreshing, protein-packed salad tossed in a lemon-olive oil dressing.",
  "servings": 2,
  "prep_minutes": 10,
  "cook_minutes": 0,
  "image_large": "/assets/images/mediterranean-chickpea-salad-large.webp",
  "image_small": "/assets/images/mediterranean-chickpea-salad-small.webp",
  "ingredients": [
    "1 can (400 g) chickpeas, drained & rinsed",
    "1 small cucumber, diced",
    "1 cup cherry tomatoes, halved",
    "1/2 red bell pepper, diced",
    "1/4 red onion, finely chopped",
    "2 Tbsp fresh parsley, chopped",
    "2 Tbsp extra-virgin olive oil",
    "1 Tbsp fresh lemon juice",
    "Sea salt & black pepper to taste"
  ],
  "instructions": [
    "In a large bowl combine chickpeas, cucumber, tomatoes, bell pepper, red onion and parsley.",
    "Drizzle with olive oil and lemon juice.",
    "Season with salt and pepper; toss to coat.",
    "Serve immediately or chill up to 2 days."
  ],
  "created_at": "2026-01-05T10:00:00.000000Z",
  "updated_at": "2026-01-05T10:00:00.000000Z",
  "total_minutes": 10,
  "ingredient_count": 9
}
```

---

## Database Setup Commands

```bash
# Create migration
php artisan make:migration create_recipes_table

# Create model
php artisan make:model Recipe

# Create seeder
php artisan make:seeder RecipeSeeder

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed --class=RecipeSeeder

# Fresh migration + seed (development)
php artisan migrate:fresh --seed
```

---

## Future Data Model Enhancements

**Post-MVP Considerations** (not in scope for initial release):

1. **Categories/Tags**

   - Many-to-many relationship with recipes
   - Enable category-based filtering

2. **User Favorites**

   - User authentication required
   - Many-to-many relationship (users ↔ recipes)

3. **Ratings/Reviews**

   - User-submitted ratings (1-5 stars)
   - Review text and timestamps

4. **Recipe Variations**

   - Ingredient substitutions
   - Dietary modifications (vegan, gluten-free)

5. **Nutritional Information**

   - Calories, protein, carbs, fat
   - Allergen warnings

6. **Recipe Collections**
   - Curated recipe groups
   - Meal planning features

---

## Data Model Summary

| Aspect            | Status     | Notes                               |
| ----------------- | ---------- | ----------------------------------- |
| **Entity Count**  | 1 (Recipe) | Simple, focused data model          |
| **Relationships** | None       | Standalone entity for MVP           |
| **Indexes**       | 3          | Slug, prep_minutes, cook_minutes    |
| **Validation**    | Robust     | Laravel validation + DB constraints |
| **Search**        | Full-text  | Title + JSON ingredient search      |
| **Performance**   | Optimized  | Indexes on filter columns           |
| **Scalability**   | Excellent  | Handles 500+ recipes without issues |

**Data Model Complete**: Ready to implement migrations, model, and seeder.
