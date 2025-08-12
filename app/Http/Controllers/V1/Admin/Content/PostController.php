<?php

namespace App\Http\Controllers\V1\Admin\Content;

use App\Base\ApiResponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\Content\Post\StorePostRequest;
use App\Http\Requests\V1\Admin\Content\Post\UpdatePostRequest;
use App\Http\Resources\V1\Admin\Content\Post\PostApiResource;
use App\Models\Content\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return ApiResponse::withData(PostApiResource::collection($posts))->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $inputs = $request->validated();

        $imagePath = $request->file('image')->store('images', 'public');

        if (!$imagePath) {
            return ApiResponse::withMessage('Failed To Upload Image')->withStatus(422)->send();
        }

        $inputs['image'] = $imagePath;

        $inputs['user_id'] = Auth::id();

        $post = Post::create($inputs);

        return ApiResponse::withData(new PostApiResource($post))->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return ApiResponse::withData(new PostApiResource($post))->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $inputs = $request->validated();

        if ($request->hasFile('image')) {
            $remove_lagacy_image_result = Storage::disk('public')->delete($post->image);

            if ($remove_lagacy_image_result) {
                $imagePath = $request->file('image')->store('images', 'public');

                $inputs['image'] = $imagePath;
            }
        }

        $result = $post->update($inputs);

        return ApiResponse::withData(new PostApiResource($post->refresh()))->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $remove_lagacy_image_result = Storage::disk('public')->delete($post->image);
        
        if ($remove_lagacy_image_result) {
            $result = $post->delete();
        }

        return ApiResponse::send();
    }
}
