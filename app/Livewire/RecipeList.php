<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class RecipeList extends Component
{
    use WithPagination;

    #[Url]
    public $searchTerm = '';

    #[Url]
    public $maxPrepTime = null;

    #[Url]
    public $maxCookTime = null;

    public $perPage = 12;

    public function getRecipesProperty()
    {
        $query = Recipe::query();

        if ($this->searchTerm) {
            $query->search($this->searchTerm);
        }

        if ($this->maxPrepTime !== null && $this->maxPrepTime !== '') {
            $query->maxPrepTime($this->maxPrepTime);
        }

        if ($this->maxCookTime !== null && $this->maxCookTime !== '') {
            $query->maxCookTime($this->maxCookTime);
        }

        return $query->orderBy('title')->paginate($this->perPage);
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedMaxPrepTime($value)
    {
        // Convert empty string to null to remove from URL
        if ($value === '' || $value === null) {
            $this->maxPrepTime = null;
        }
        $this->resetPage();
    }

    public function updatedMaxCookTime($value)
    {
        // Convert empty string to null to remove from URL
        if ($value === '' || $value === null) {
            $this->maxCookTime = null;
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['searchTerm', 'maxPrepTime', 'maxCookTime']);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.recipe-list', [
            'recipes' => $this->recipes,
        ]);
    }
}
