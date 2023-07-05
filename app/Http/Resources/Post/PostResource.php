<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->resource->id,
            'title'      => $this->resource->title,
            'content'    => $this->resource->content,
            'user'       => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->resource->created_at,
            'states'     => PostStatesResource::make($this->resource),
        ];
    }
}
