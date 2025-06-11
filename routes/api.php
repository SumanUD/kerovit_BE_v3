<?php

// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\RangeController;

Route::get('/products/json', [ProductController::class, 'getAllProductsJson']);
