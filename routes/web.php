<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipes', [RecipeController::class, 'showForm'])->name('recipe.form');
Route::post('/recipes/generate', [RecipeController::class, 'generate'])->name('recipe.generate');
