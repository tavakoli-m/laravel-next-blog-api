<?php

namespace App\Http\Controllers\V1\Admin\Content;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\Content\Category\StoreCategoryRequest;
use App\Http\Requests\V1\Admin\Content\Category\UpdateCategoryRequest;
use App\Http\Resources\V1\Admin\Content\Category\CategoryApiResource;
use App\Models\Content\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return ApiResponse::withData(CategoryApiResource::collection($categories))->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return ApiResponse::withData(new CategoryApiResource($category))->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return ApiResponse::withData(new CategoryApiResource($category))->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $result = $category->update($request->validated());

        return ApiResponse::withData(new CategoryApiResource($category->refresh()))->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $result = $category->delete();

        return ApiResponse::send();
    }
}
