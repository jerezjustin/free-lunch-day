<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => ['Laravel' => app()->version()]);

Route::resource('/orders', OrderController::class)->only(['index', 'store']);
