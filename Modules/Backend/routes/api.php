<?php

use Illuminate\Support\Facades\Route;
use Modules\Backend\Http\Controllers\BackendController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('backends', BackendController::class)->names('backend');
});
