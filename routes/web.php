<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Resources\ErrorResource;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->withoutMiddleware('web')->group(function () {
    Route::prefix('vehicles')->group(function () {
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/', [VehicleController::class, 'store']);
        Route::post('/{vehicle}/assign-driver', [VehicleController::class, 'assignDriver'])->whereNumber('vehicle');
    });

    Route::prefix('drivers')->group(function () {
        Route::get('/', [DriverController::class, 'index']);
        Route::post('/', [DriverController::class, 'store']);
    });
});

Route::fallback(function () {
    return new ErrorResource(
        message: 'Route not found',
        status: 404,
    );
});