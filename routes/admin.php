<?php

use App\Presentation\Http\Controllers\Backend\Auth\LoginController;
use App\Presentation\Http\Controllers\Backend\Auth\LogoutController;
use App\Presentation\Http\Controllers\Backend\Auth\ShowLoginController;
use App\Presentation\Http\Controllers\Backend\Content\CategoryController;
use App\Presentation\Http\Controllers\Backend\Content\PostController;
use App\Presentation\Http\Controllers\Backend\Content\ProductController;
use App\Presentation\Http\Controllers\Backend\Content\WidgetController;
use App\Presentation\Http\Controllers\Backend\DashboardController;
use App\Presentation\Http\Controllers\Backend\Management\CreateRoleController;
use App\Presentation\Http\Controllers\Backend\Management\CreateUserController;
use App\Presentation\Http\Controllers\Backend\Management\DestroyRoleController;
use App\Presentation\Http\Controllers\Backend\Management\DestroyUserController;
use App\Presentation\Http\Controllers\Backend\Management\EditRoleController;
use App\Presentation\Http\Controllers\Backend\Management\EditUserController;
use App\Presentation\Http\Controllers\Backend\Management\RoleManagementController;
use App\Presentation\Http\Controllers\Backend\Management\StoreRoleController;
use App\Presentation\Http\Controllers\Backend\Management\StoreUserController;
use App\Presentation\Http\Controllers\Backend\Management\UpdateRoleController;
use App\Presentation\Http\Controllers\Backend\Management\UpdateUserController;
use App\Presentation\Http\Controllers\Backend\Management\UserManagementController;
use App\Presentation\Http\Controllers\Backend\Security\DisableTwoFactorController;
use App\Presentation\Http\Controllers\Backend\Security\EnableTwoFactorController;
use App\Presentation\Http\Controllers\Backend\Security\ShowTwoFactorChallengeController;
use App\Presentation\Http\Controllers\Backend\Security\ShowTwoFactorSettingsController;
use App\Presentation\Http\Controllers\Backend\Security\VerifyTwoFactorChallengeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', ShowLoginController::class)->name('login');
        Route::post('/login', LoginController::class)->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/two-factor/challenge', ShowTwoFactorChallengeController::class)->name('two-factor.challenge');
        Route::post('/two-factor/challenge', VerifyTwoFactorChallengeController::class)->name('two-factor.verify');

        Route::get('/security/two-factor', ShowTwoFactorSettingsController::class)
            ->middleware('admin.twofactor')
            ->name('two-factor.settings');
        Route::post('/security/two-factor/enable', EnableTwoFactorController::class)
            ->middleware('admin.twofactor')
            ->name('two-factor.enable');
        Route::post('/security/two-factor/disable', DisableTwoFactorController::class)
            ->middleware('admin.twofactor')
            ->name('two-factor.disable');

        Route::middleware('admin.twofactor')->group(function () {
            Route::get('/dashboard', DashboardController::class)
                ->name('dashboard');

            // Quản lý Menu
            Route::get('/menu', [\App\Http\Controllers\Backend\MenuController::class, 'index'])
                ->name('menu.index');
            Route::post('/menu', [\App\Http\Controllers\Backend\MenuController::class, 'store'])
                ->name('menu.store');
            Route::put('/menu/{menuItem}', [\App\Http\Controllers\Backend\MenuController::class, 'update'])
                ->name('menu.update');
            Route::post('/menu/reorder', [\App\Http\Controllers\Backend\MenuController::class, 'reorder'])
                ->name('menu.reorder');
            Route::delete('/menu/{menuItem}', [\App\Http\Controllers\Backend\MenuController::class, 'destroy'])
                ->name('menu.destroy');

            // Quản lý Chuyên gia
            Route::resource('experts', \App\Http\Controllers\Backend\ExpertController::class)
                ->names('experts');

            Route::get('/widgets', [WidgetController::class, 'index'])
                ->name('widgets.index');
            Route::get('/widgets/{widget}/edit', [WidgetController::class, 'edit'])
                ->name('widgets.edit');
            Route::put('/widgets/{widget}', [WidgetController::class, 'update'])
                ->name('widgets.update');
            Route::patch('/widgets/{widget}/toggle', [WidgetController::class, 'toggle'])
                ->name('widgets.toggle');
            Route::post('/widgets/reorder', [WidgetController::class, 'reorder'])
                ->name('widgets.reorder');

            Route::get('/product-categories', [CategoryController::class, 'index'])
                ->defaults('module', 'product')
                ->name('product-categories.index');
            Route::get('/product-categories/create', [CategoryController::class, 'create'])
                ->defaults('module', 'product')
                ->name('product-categories.create');
            Route::post('/product-categories', [CategoryController::class, 'store'])
                ->defaults('module', 'product')
                ->name('product-categories.store');
            Route::get('/product-categories/{category}/edit', [CategoryController::class, 'edit'])
                ->defaults('module', 'product')
                ->name('product-categories.edit');
            Route::put('/product-categories/{category}', [CategoryController::class, 'update'])
                ->defaults('module', 'product')
                ->name('product-categories.update');
            Route::delete('/product-categories/{category}', [CategoryController::class, 'destroy'])
                ->defaults('module', 'product')
                ->name('product-categories.destroy');

            Route::get('/news-categories', [CategoryController::class, 'index'])
                ->defaults('module', 'news')
                ->name('news-categories.index');
            Route::get('/news-categories/create', [CategoryController::class, 'create'])
                ->defaults('module', 'news')
                ->name('news-categories.create');
            Route::post('/news-categories', [CategoryController::class, 'store'])
                ->defaults('module', 'news')
                ->name('news-categories.store');
            Route::get('/news-categories/{category}/edit', [CategoryController::class, 'edit'])
                ->defaults('module', 'news')
                ->name('news-categories.edit');
            Route::put('/news-categories/{category}', [CategoryController::class, 'update'])
                ->defaults('module', 'news')
                ->name('news-categories.update');
            Route::delete('/news-categories/{category}', [CategoryController::class, 'destroy'])
                ->defaults('module', 'news')
                ->name('news-categories.destroy');

            Route::get('/products', [ProductController::class, 'index'])->name('products.index');
            Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('products.store');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

            Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
            Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
            Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
            Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
            Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
            Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

            Route::get('/users', UserManagementController::class)
                ->name('users.index');
            Route::get('/users/create', CreateUserController::class)
                ->name('users.create');
            Route::post('/users', StoreUserController::class)
                ->name('users.store');
            Route::get('/users/{user}/edit', EditUserController::class)
                ->name('users.edit');
            Route::put('/users/{user}', UpdateUserController::class)
                ->name('users.update');
            Route::delete('/users/{user}', DestroyUserController::class)
                ->name('users.destroy');
        });

        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
