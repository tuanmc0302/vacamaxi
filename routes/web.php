<?php

use App\Presentation\Http\Controllers\Frontend\HomeController;
use App\Presentation\Http\Controllers\Frontend\AboutController;
use App\Presentation\Http\Controllers\Frontend\NewsController;
use App\Presentation\Http\Controllers\Frontend\ProductController;
use App\Presentation\Http\Controllers\Frontend\RestaurantController;
use Illuminate\Support\Facades\Route;

$frontendRoutes = function () {
    Route::get('/', HomeController::class)->name('frontend.home');

    Route::get('/{about}', [AboutController::class, 'show'])->where('about', 'gioi-thieu|about')->name('frontend.about');

    Route::get('/{contact}', [AboutController::class, 'contact'])->where('contact', 'lien-he|contact')->name('frontend.contact');
    Route::post('/{contact}', [AboutController::class, 'submitContact'])->where('contact', 'lien-he|contact')->name('frontend.contact.submit');

    Route::get('/{about_scale}', [AboutController::class, 'scale'])->where('about_scale', 'gioi-thieu-quy-mo|about-scale')->name('frontend.about.scale');
    Route::get('/gioi-thieu-quy-mo-figma', [AboutController::class, 'scaleFigma'])->name('frontend.about.scale.figma');

    Route::get('/{restaurant}', RestaurantController::class)->where('restaurant', 'dich-vu-nha-hang|restaurant')->name('frontend.restaurant');

    Route::get('/{products}', [ProductController::class, 'index'])->where('products', 'san-pham|products')->name('frontend.products.index');
    Route::get('/{products}/{breeds}', [ProductController::class, 'breeds'])->where(['products' => 'san-pham|products', 'breeds' => 'giong-bo-vacamaxi|breeds'])->name('frontend.products.breeds');
    Route::get('/{products}/{categorySlug}', [ProductController::class, 'category'])->where('products', 'san-pham|products')->name('frontend.products.category');
    Route::get('/{products}/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->where('products', 'san-pham|products')->name('frontend.product.show');

    Route::get('/{news}', [NewsController::class, 'index'])->where('news', 'tin-tuc|news')->name('frontend.news.index');
    Route::get('/{news}/{category_word}/{categorySlug}', [NewsController::class, 'category'])->where(['news' => 'tin-tuc|news', 'category_word' => 'danh-muc|category'])->name('frontend.news.category');
    Route::get('/{news}/{slug}', [NewsController::class, 'show'])->where('news', 'tin-tuc|news')->name('frontend.news.show');
    Route::post('/{news}/{post}/comment', [NewsController::class, 'submitComment'])->where('news', 'tin-tuc|news')->name('frontend.news.comment.submit');
};

// English routes (with /en prefix) — registered FIRST so VI group names win for route() generation
Route::prefix('en')->group(function () use ($frontendRoutes) {
    // Re-register same routes but with .en suffix on names to avoid collisions
    Route::get('/', HomeController::class)->name('frontend.home.en');

    Route::get('/{about}', [AboutController::class, 'show'])->where('about', 'gioi-thieu|about')->name('frontend.about.en');

    Route::get('/{contact}', [AboutController::class, 'contact'])->where('contact', 'lien-he|contact')->name('frontend.contact.en');
    Route::post('/{contact}', [AboutController::class, 'submitContact'])->where('contact', 'lien-he|contact')->name('frontend.contact.submit.en');

    Route::get('/{about_scale}', [AboutController::class, 'scale'])->where('about_scale', 'gioi-thieu-quy-mo|about-scale')->name('frontend.about.scale.en');
    Route::get('/gioi-thieu-quy-mo-figma', [AboutController::class, 'scaleFigma'])->name('frontend.about.scale.figma.en');

    Route::get('/{restaurant}', RestaurantController::class)->where('restaurant', 'dich-vu-nha-hang|restaurant')->name('frontend.restaurant.en');

    Route::get('/{products}', [ProductController::class, 'index'])->where('products', 'san-pham|products')->name('frontend.products.index.en');
    Route::get('/{products}/{breeds}', [ProductController::class, 'breeds'])->where(['products' => 'san-pham|products', 'breeds' => 'giong-bo-vacamaxi|breeds'])->name('frontend.products.breeds.en');
    Route::get('/{products}/{categorySlug}', [ProductController::class, 'category'])->where('products', 'san-pham|products')->name('frontend.products.category.en');
    Route::get('/{products}/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->where('products', 'san-pham|products')->name('frontend.product.show.en');

    Route::get('/{news}', [NewsController::class, 'index'])->where('news', 'tin-tuc|news')->name('frontend.news.index.en');
    Route::get('/{news}/{category_word}/{categorySlug}', [NewsController::class, 'category'])->where(['news' => 'tin-tuc|news', 'category_word' => 'danh-muc|category'])->name('frontend.news.category.en');
    Route::get('/{news}/{slug}', [NewsController::class, 'show'])->where('news', 'tin-tuc|news')->name('frontend.news.show.en');
    Route::post('/{news}/{post}/comment', [NewsController::class, 'submitComment'])->where('news', 'tin-tuc|news')->name('frontend.news.comment.submit.en');
});

// Vietnamese routes (no prefix) — registered LAST so their names win for route() generation
$frontendRoutes();
