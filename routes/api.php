<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactDetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MeterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
   Route::post('/login', [AuthController::class, 'login']);
   Route::post('/register', [AuthController::class, 'register']);
});


Route::middleware('auth:sanctum')->group(function () {

   Route::prefix('v1/customer')->group(function () {
      Route::post('/', [CustomerController::class, 'store']);
      Route::get('/', [CustomerController::class, 'myCustomers']);
      Route::post('/billing-preference', [CustomerController::class, 'billingPreference']);
      Route::get('/{customerId}', [CustomerController::class, 'show']);
   });

   Route::prefix('v1/site')->group(function () {
      Route::post('/', [SiteController::class, 'store']);
      Route::get('/', [SiteController::class, 'mySites']);
      Route::get('/{siteId}', [SiteController::class, 'show'])
         ->middleware('can.access.site');
   });

   Route::prefix('v1/meters')->group(function () {
      Route::post('/', [MeterController::class, 'store']);
      Route::get('/', [MeterController::class, 'myMeters']);
      Route::get('/{meterId}', [MeterController::class, 'show']);
   });

   Route::prefix('v1/contact-details')->group(function () {
      Route::post('/', [ContactDetailController::class, 'create']);
   });

});
