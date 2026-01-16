<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app', ['pageClass' => 'page-recipe'])]
class RecipeDetail extends Component
{
    public Recipe $recipe;

    public function mount($slug)
    {
        $this->recipe = Recipe::where('slug', $slug)->firstOrFail();
    }

    public function title()
    {
        return $this->recipe->title . ' - Recipe Finder';
    }

    public function getRelatedRecipesProperty()
    {
        return Recipe::where('id', '!=', $this->recipe->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.recipe-detail', [
            'relatedRecipes' => $this->relatedRecipes,
        ]);
    }
}
