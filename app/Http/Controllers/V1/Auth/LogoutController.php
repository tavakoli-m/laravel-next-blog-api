<?php

namespace App\Http\Controllers\V1\Auth;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        Auth::user()->currentAccessToken()->delete();

        return ApiResponse::send();
    }
}
