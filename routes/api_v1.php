<?php

use App\Base\ApiResponse\Facades\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('/',fn() => ApiResponse::send());