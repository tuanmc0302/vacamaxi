<?php

use App\Presentation\Http\Controllers\Backend\Auth\LoginController;
use App\Presentation\Http\Controllers\Backend\Auth\LogoutController;
use App\Presentation\Http\Controllers\Backend\Auth\ShowLoginController;
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
