<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/receitas', [RecipeController::class, 'index'])
    ->name('recipes.index');

Route::get('/receitas/criar', [RecipeController::class, 'create'])
    ->middleware('auth')
    ->name('recipes.create');

Route::post('/receitas', [RecipeController::class, 'store'])
    ->middleware('auth')
    ->name('recipes.store');

Route::get('/receitas/{slug}', [RecipeController::class, 'show'])
    ->name('recipes.show');

Route::view('/comunidade', 'pages.section', [
    'pageTitle' => 'Comunidade',
    'eyebrow' => 'JUNTOS NA COZINHA',
    'description' => 'Compartilhe experiências e descubra novos talentos.',
    'section' => 'community',
])->name('community');

Route::view('/desafios', 'pages.section', [
    'pageTitle' => 'Desafios',
    'eyebrow' => 'SAIA DA ROTINA',
    'description' => 'Experimente, prepare e supere novos desafios culinários.',
    'section' => 'challenges',
])->name('challenges');

Route::view('/assistente', 'pages.section', [
    'pageTitle' => 'Assistente SuChef',
    'eyebrow' => 'SEU AJUDANTE CULINÁRIO',
    'description' => 'Uma ajudinha para transformar ingredientes em possibilidades.',
    'section' => 'assistant',
])->name('assistant');

Route::get('/perfil', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

Route::get('/configuracoes', [SettingsController::class, 'edit'])
    ->middleware('auth')
    ->name('settings.edit');

    Route::put('/configuracoes', [SettingsController::class, 'update'])
    ->middleware('auth')
    ->name('settings.update');

Route::get('/cadastro', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/cadastro', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');