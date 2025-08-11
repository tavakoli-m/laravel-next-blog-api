<?php

namespace App\Http\Controllers\V1\Auth;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        if ($user = User::where('email', $request->input('email'))->first()) {
            return ApiResponse::withStatus(422)->withMessage('Email already exists !!!')->send();
        }

        $formData = $request->validated();

        $formData['password'] = Hash::make($request->input('password'));

        $user = User::create($formData);

        $token = $user->createToken($request->userAgent())->plainTextToken;

        return ApiResponse::withData([
            'token' => $token
        ])->send();
    }
}
