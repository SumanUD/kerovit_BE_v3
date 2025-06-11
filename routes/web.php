<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\BlogController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/session', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/forgot-password', [LoginController::class, 'forgotPassword']);
Route::get('/reset-password/{token}', [LoginController::class, 'indexResetPassword'])->name('reset-password');
Route::post('/reset-password/{token}', [LoginController::class, 'postReset']);

/*
|--------------------------------------------------------------------------
| Authenticated Admin Routes (Protected by Admin Middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['Admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Collections
    |--------------------------------------------------------------------------
    */
    Route::controller(CollectionController::class)->group(function () {
        Route::get('/admin/collections', 'index')->name('collections.index');
        Route::post('/admin/collections', 'store')->name('collections.store');
        Route::put('/admin/collections/{collection}', 'update')->name('collections.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Ranges
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('ranges', [RangeController::class, 'index'])->name('ranges.index');
        Route::post('ranges', [RangeController::class, 'store'])->name('ranges.store');
        Route::put('ranges/{range}', [RangeController::class, 'update'])->name('ranges.update');
        Route::delete('ranges/{range}', [RangeController::class, 'destroy'])->name('ranges.destroy');
        Route::get('ranges/get-categories', [RangeController::class, 'getCategoriesByCollection'])->name('ranges.getCategoriesByCollection');
    });

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::get('/products/{id}/view', [ProductController::class, 'edit'])->name('products.edit'); // Consider changing to `view` method if needed
        Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    });

    // Product Data (AJAX)
    Route::get('/products/getdata', [ProductController::class, 'showData'])->name('products.index');
    Route::get('/products/data', [ProductController::class, 'getData'])->name('products.data');
    Route::get('/admin/products/collections/{collectionId}/categories', [ProductController::class, 'getCategories'])->name('products.getCategories');
    Route::get('/admin/products/categories/{categoryId}/ranges', [ProductController::class, 'getRanges'])->name('products.getRanges');

    /*
    |--------------------------------------------------------------------------
    | Blogs
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::post('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });

    // Blog Data (AJAX)
    Route::get('/blogs/data', [BlogController::class, 'showData'])->name('blog.data');
    Route::get('/blogs/getdata', [BlogController::class, 'getData'])->name('blog.getdata');

    /*
    |--------------------------------------------------------------------------
    | Admin CMS Pages
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::resource('dealers', DealerController::class);
        Route::resource('homepage', HomePageController::class);
        Route::resource('about', AboutController::class);
        Route::resource('career', CareerController::class);
        Route::resource('catalogue', CatalogueController::class);
    });

});
