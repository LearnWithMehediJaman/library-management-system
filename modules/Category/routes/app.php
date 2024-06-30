<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::get('category', [
    CategoryController::class, 'index', 
])->name('category.index');

Route::get('category/create', [
    CategoryController::class, 'create',
])->name('category.create');

Route::post('category', [
    CategoryController::class, 'store',
])->name('category.store');

Route::get('category/{id}/edit', [
    CategoryController::class, 'edit',
])->name('category.edit');

Route::put('category/{id}', [
    CategoryController::class, 'update',
])->name('category.update');

Route::delete('category/{id}', [
    CategoryController::class, 'destroy',
])->name('category.destroy');
