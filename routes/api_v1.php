<?php

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register',RegisterController::class);