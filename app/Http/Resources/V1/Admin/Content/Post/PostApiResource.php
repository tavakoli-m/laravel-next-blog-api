<?php

namespace App\Http\Resources\V1\Admin\Content\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'body' => $this->body,
            'image' => $this->image,
            'category' => new PostCategoryDetailsApiResource($this->category),
            'user_id' => new PostUserDetailsApiResource($this->user),
        ];
    }
}
