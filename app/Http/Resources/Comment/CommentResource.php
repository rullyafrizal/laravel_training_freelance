<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'created_at' => $this->created_at->diffForHumans(),
            'post' => new PostResource($this->whenLoaded('post')),
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
