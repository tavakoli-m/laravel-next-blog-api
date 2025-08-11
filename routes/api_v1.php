<?php

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\V1\Admin\Content\CategoryController;
use App\Http\Controllers\V1\Auth\GetMeController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\LogoutController;
use App\Http\Controllers\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register',RegisterController::class);
Route::post('/login',LoginController::class);
Route::post('/logout',LogoutController::class)->middleware('auth:sanctum');
Route::get('/me',GetMeController::class)->middleware('auth:sanctum');

Route::apiResource('/category',CategoryController::class)->middleware('auth:sanctum');