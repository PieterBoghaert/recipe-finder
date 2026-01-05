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

// Recipes Page (will use Livewire component)
Route::get('/recipes', function () {
    return view('pages.recipes');
})->name('recipes');

// Recipe Detail Page (will use Livewire component)
Route::get('/recipe/{slug}', function ($slug) {
    return view('pages.recipe', ['slug' => $slug]);
})->name('recipe.show');
