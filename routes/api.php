<?php

use App\Presentation\Http\Controllers\Api\V1\SystemStatusController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/system/status', SystemStatusController::class)->name('api.v1.system.status');
});
