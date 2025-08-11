<?php

namespace App\Http\Controllers\V1\Auth;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return ApiResponse::withStatus(401)->withMessage('Credentials not valid.')->send();
        }

        $token = Auth::user()->createToken($request->userAgent())->plainTextToken;

        return ApiResponse::withData([
            'token' => $token
        ])->send();
    }
}
