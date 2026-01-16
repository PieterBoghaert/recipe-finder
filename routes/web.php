<?php

use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// About Page
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Recipes Page (Livewire full-page component)
Route::livewire('/recipes', \App\Livewire\RecipeList::class)
    ->name('recipes');

// Recipe Detail Page (Livewire full-page component)
Route::livewire('/recipe/{slug}', \App\Livewire\RecipeDetail::class)
    ->name('recipe.show');
