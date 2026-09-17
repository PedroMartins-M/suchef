<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/receitas', [RecipeController::class, 'index'])
    ->name('recipes.index');