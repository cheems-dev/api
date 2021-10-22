<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'store'])->name('api.v1.register');


// Route::get('catogories', [CategoryController::class, 'index'])->name('api.v1.categories.index');
// Route::post('catogories', [CategoryController::class, 'store'])->name('api.v1.categories.store');
// Route::get('catogories/{category}', [CategoryController::class, 'show'])->name('api.v1.categories.show');
// Route::put('catogories/{category}', [CategoryController::class, 'update'])->name('api.v1.categories.update');
// Route::delete('catogories/{category}', [CategoryController::class, 'destroy'])->name('api.v1.categories.destroy');

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');
