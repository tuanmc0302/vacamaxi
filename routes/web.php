<?php

use App\Presentation\Http\Controllers\Frontend\HomeController;
use App\Presentation\Http\Controllers\Frontend\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('frontend.home');
Route::view('/gioi-thieu', 'frontend.about')->name('frontend.about');
Route::view('/san-pham', 'frontend.product-detail')->name('frontend.product-detail');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('frontend.news.index');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'show'])->name('frontend.news.show');
