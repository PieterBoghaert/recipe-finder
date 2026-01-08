<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Recipe extends Model
{
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
            get: fn() => $this->prep_minutes + $this->cook_minutes,
        );
    }

    public function ingredientCount(): Attribute
    {
        return Attribute::make(
            get: fn() => count($this->ingredients),
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
