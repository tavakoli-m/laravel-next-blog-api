<?php

use App\Http\Controllers\V1\Admin\Content\CategoryController;
use App\Http\Controllers\V1\Admin\Content\PostController;
use App\Http\Controllers\V1\Auth\GetMeController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\LogoutController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Customer\CategoryController as CustomerCategoryController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
Route::get('/me', GetMeController::class)->middleware('auth:sanctum');

Route::apiResource('/category', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('/post', PostController::class)->middleware('auth:sanctum');

Route::get('/categories',CustomerCategoryController::class);