<?php

namespace App\Http\Controllers\V1\Customer;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\CategoryListApiResource;
use App\Models\Content\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::all();

        return ApiResponse::withData(CategoryListApiResource::collection($categories))->send();
    }
}
