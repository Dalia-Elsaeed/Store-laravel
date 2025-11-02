<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use GuzzleHttp\Middleware;

Route::group(
    [
        'middleware' => ['auth'],
        'as' => 'dashboard.',
        'prefix' => 'dashboard',
        // 'namespace' => 'App\Http\Controllers\Dashboard',
    ],
    function () {

        Route::get('/', [CategoriesController::class, 'index'])
            ->name('dashboard');
        //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/categories/trash', [CategoriesController::class, 'trash'])
            ->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
            ->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
            ->name('categories.force-delete');

        Route::resource('/categories', CategoriesController::class);
        Route::resource('/products', ProductsController::class);
        
    }
);
