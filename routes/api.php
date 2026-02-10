<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactDetailController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('v1/site')->group(function () {
        Route::post('/store', [SiteController::class, 'store']);
        Route::post('/update', [SiteController::class, 'update']);
    });

    Route::prefix('v1/contact-details')->group(function () {
        Route::get('/contact-details', [ContactDetailController::class, 'show']);
        Route::put('/contact-details', [ContactDetailController::class, 'update']);
    });


});


