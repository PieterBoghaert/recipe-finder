<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
