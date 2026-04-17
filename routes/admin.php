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
                ->middleware('permission:admin.dashboard.view')
                ->name('dashboard');

            Route::get('/widgets', [WidgetController::class, 'index'])
                ->middleware('permission:admin.widgets.view')
                ->name('widgets.index');
            Route::get('/widgets/{widget}/edit', [WidgetController::class, 'edit'])
                ->middleware('permission:admin.widgets.edit')
                ->name('widgets.edit');
            Route::put('/widgets/{widget}', [WidgetController::class, 'update'])
                ->middleware('permission:admin.widgets.edit')
                ->name('widgets.update');
            Route::patch('/widgets/{widget}/toggle', [WidgetController::class, 'toggle'])
                ->middleware('permission:admin.widgets.edit')
                ->name('widgets.toggle');
            Route::post('/widgets/reorder', [WidgetController::class, 'reorder'])
                ->middleware('permission:admin.widgets.edit')
                ->name('widgets.reorder');

            Route::get('/product-categories', [CategoryController::class, 'index'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.view')
                ->name('product-categories.index');
            Route::get('/product-categories/create', [CategoryController::class, 'create'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.create')
                ->name('product-categories.create');
            Route::post('/product-categories', [CategoryController::class, 'store'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.create')
                ->name('product-categories.store');
            Route::get('/product-categories/{category}/edit', [CategoryController::class, 'edit'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.edit')
                ->name('product-categories.edit');
            Route::put('/product-categories/{category}', [CategoryController::class, 'update'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.edit')
                ->name('product-categories.update');
            Route::delete('/product-categories/{category}', [CategoryController::class, 'destroy'])
                ->defaults('module', 'product')
                ->middleware('permission:admin.categories.delete')
                ->name('product-categories.destroy');

            Route::get('/news-categories', [CategoryController::class, 'index'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.view')
                ->name('news-categories.index');
            Route::get('/news-categories/create', [CategoryController::class, 'create'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.create')
                ->name('news-categories.create');
            Route::post('/news-categories', [CategoryController::class, 'store'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.create')
                ->name('news-categories.store');
            Route::get('/news-categories/{category}/edit', [CategoryController::class, 'edit'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.edit')
                ->name('news-categories.edit');
            Route::put('/news-categories/{category}', [CategoryController::class, 'update'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.edit')
                ->name('news-categories.update');
            Route::delete('/news-categories/{category}', [CategoryController::class, 'destroy'])
                ->defaults('module', 'news')
                ->middleware('permission:admin.categories.delete')
                ->name('news-categories.destroy');

            Route::get('/products', [ProductController::class, 'index'])->middleware('permission:admin.products.view')->name('products.index');
            Route::get('/products/create', [ProductController::class, 'create'])->middleware('permission:admin.products.create')->name('products.create');
            Route::post('/products', [ProductController::class, 'store'])->middleware('permission:admin.products.create')->name('products.store');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('permission:admin.products.edit')->name('products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('permission:admin.products.edit')->name('products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('permission:admin.products.delete')->name('products.destroy');

            Route::get('/posts', [PostController::class, 'index'])->middleware('permission:admin.posts.view')->name('posts.index');
            Route::get('/posts/create', [PostController::class, 'create'])->middleware('permission:admin.posts.create')->name('posts.create');
            Route::post('/posts', [PostController::class, 'store'])->middleware('permission:admin.posts.create')->name('posts.store');
            Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('permission:admin.posts.edit')->name('posts.edit');
            Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('permission:admin.posts.edit')->name('posts.update');
            Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('permission:admin.posts.delete')->name('posts.destroy');

            Route::get('/users', UserManagementController::class)
                ->middleware('permission:admin.users.view')
                ->name('users.index');
            Route::get('/users/create', CreateUserController::class)
                ->middleware('permission:admin.users.create')
                ->name('users.create');
            Route::post('/users', StoreUserController::class)
                ->middleware('permission:admin.users.create')
                ->name('users.store');
            Route::get('/users/{user}/edit', EditUserController::class)
                ->middleware('permission:admin.users.edit')
                ->name('users.edit');
            Route::put('/users/{user}', UpdateUserController::class)
                ->middleware('permission:admin.users.edit')
                ->name('users.update');
            Route::delete('/users/{user}', DestroyUserController::class)
                ->middleware('permission:admin.users.delete')
                ->name('users.destroy');

            Route::get('/roles', RoleManagementController::class)
                ->middleware('permission:admin.roles.view')
                ->name('roles.index');
            Route::get('/roles/create', CreateRoleController::class)
                ->middleware('permission:admin.roles.create')
                ->name('roles.create');
            Route::post('/roles', StoreRoleController::class)
                ->middleware('permission:admin.roles.create')
                ->name('roles.store');
            Route::get('/roles/{role}/edit', EditRoleController::class)
                ->middleware('permission:admin.roles.create')
                ->name('roles.edit');
            Route::put('/roles/{role}', UpdateRoleController::class)
                ->middleware('permission:admin.roles.create')
                ->name('roles.update');
            Route::delete('/roles/{role}', DestroyRoleController::class)
                ->middleware('permission:admin.roles.delete')
                ->name('roles.destroy');
        });

        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
