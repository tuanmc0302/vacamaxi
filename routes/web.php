<?php

use App\Presentation\Http\Controllers\Frontend\HomeController;
use App\Presentation\Http\Controllers\Frontend\AboutController;
use App\Presentation\Http\Controllers\Frontend\NewsController;
use App\Presentation\Http\Controllers\Frontend\ProductController;
use App\Presentation\Http\Controllers\Frontend\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('frontend.home');
Route::get('/gioi-thieu', [AboutController::class, 'show'])->name('frontend.about');
Route::get('/gioi-thieu-quy-mo', [AboutController::class, 'scale'])->name('frontend.about.scale');
Route::get('/gioi-thieu-quy-mo-figma', [AboutController::class, 'scaleFigma'])->name('frontend.about.scale.figma');
Route::get('/dich-vu-nha-hang', RestaurantController::class)->name('frontend.restaurant');
Route::get('/san-pham', [ProductController::class, 'index'])->name('frontend.products.index');
Route::get('/san-pham/{categorySlug}', [ProductController::class, 'category'])->name('frontend.products.category');
Route::get('/san-pham/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->name('frontend.product.show');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('frontend.news.index');
Route::get('/tin-tuc/danh-muc/{categorySlug}', [NewsController::class, 'category'])->name('frontend.news.category');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'show'])->name('frontend.news.show');
