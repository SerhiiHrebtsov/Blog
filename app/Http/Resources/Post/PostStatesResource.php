<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class PostStatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'editable'  => Gate::inspect('edit-post', $this->resource)->allowed(),
            'deletable' => Gate::inspect('delete-post', $this->resource)->allowed(),
        ];
    }
}
