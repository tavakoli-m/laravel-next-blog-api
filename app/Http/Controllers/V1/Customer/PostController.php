<?php

namespace App\Http\Controllers\V1\Customer;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\PostsListApiResource;
use App\Models\Content\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with(['category'])->get();

        return ApiResponse::withData(PostsListApiResource::collection($posts))->send();
    }
}
