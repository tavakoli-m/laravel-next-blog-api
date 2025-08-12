<?php

namespace App\Http\Controllers\V1\Customer;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\PostsListApiResource;
use App\Models\Content\Category;
use Illuminate\Http\Request;

class CategoryPostsListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Category $category)
    {
        return ApiResponse::withData(PostsListApiResource::collection($category->posts))->send();
    }
}
