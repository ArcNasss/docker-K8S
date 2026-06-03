<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\VariantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(['role:admin_tenant'])->group(function () {
        Route::apiResource('themes', ThemeController::class);
        Route::apiResource('sections', SectionController::class);
        Route::apiResource('variants', VariantController::class);
    });
});
