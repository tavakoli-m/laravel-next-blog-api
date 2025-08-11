<?php

namespace App\Http\Controllers\V1\Auth;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Auth\GetMeApiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetMeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return ApiResponse::withData(New GetMeApiResource(Auth::user()))->send();
    }
}
