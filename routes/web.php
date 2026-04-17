<?php

use App\Presentation\Http\Controllers\Frontend\HomeController;
use App\Presentation\Http\Controllers\Frontend\NewsController;
use App\Presentation\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('frontend.home');
Route::view('/gioi-thieu', 'frontend.about')->name('frontend.about');
Route::get('/san-pham', [ProductController::class, 'index'])->name('frontend.products.index');
Route::get('/san-pham/{categorySlug}', [ProductController::class, 'category'])->name('frontend.products.category');
Route::get('/san-pham/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->name('frontend.product.show');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('frontend.news.index');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'show'])->name('frontend.news.show');
