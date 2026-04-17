<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'frontend.home')->name('frontend.home');
Route::view('/gioi-thieu', 'frontend.about')->name('frontend.about');
Route::view('/san-pham', 'frontend.product-detail')->name('frontend.product-detail');
Route::view('/tin-tuc/ruou-trang-tam-coc', 'frontend.news-detail')->name('frontend.news-detail');
