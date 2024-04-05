<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => ['Laravel' => app()->version()]);
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::resource('/orders', OrderController::class)->only(['index', 'store']);
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
