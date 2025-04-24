<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('product/{category}', [Controllers\HomeController::class, 'product'])->name('home.product');
Route::get('category/{category}', [Controllers\HomeController::class, 'category'])->name('home.category');
Route::get('search', [Controllers\HomeController::class, 'search'])->name('home.search');
Route::get('home', [Controllers\HomeController::class, 'redirectToAdmin'])->name('home.redirectToAdmin');

Route::group(['middleware' => 'revalidate'], function() {
    Auth::routes(['register' => false,'reset' => false]);
    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    
    // Product routes
    Route::prefix('admin/product')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'product'])->name('admin.product');
        Route::get('delete/{category}', [App\Http\Controllers\AdminController::class, 'delete_product'])->name('admin.delete_product');
        Route::post('edit', [App\Http\Controllers\AdminController::class, 'edit_product'])->name('admin.edit_product');
        Route::post('create', [App\Http\Controllers\AdminController::class, 'create_product'])->name('admin.create_product');
        Route::post('update', [App\Http\Controllers\AdminController::class, 'update_product'])->name('admin.update_product');
    });

    // Category routes
    Route::prefix('admin/category')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'category'])->name('admin.category');
        Route::get('delete/{category}', [App\Http\Controllers\AdminController::class, 'delete_category'])->name('admin.delete_category');
        Route::post('create', [App\Http\Controllers\AdminController::class, 'create_category'])->name('admin.create_category');
        Route::post('update', [App\Http\Controllers\AdminController::class, 'update_category'])->name('admin.update_category');
    });

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
        Route::post('update', [App\Http\Controllers\AdminController::class, 'update_profile'])->name('admin.update_profile');
    });
});
