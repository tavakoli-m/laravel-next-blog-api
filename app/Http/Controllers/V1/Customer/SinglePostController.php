<?php

namespace App\Http\Controllers\V1\Customer;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\SinglePostApiResource;
use App\Models\Content\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Post $post)
    {
        return ApiResponse::withData(new SinglePostApiResource($post))->send();
    }
}
