<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'created_at' => $this->created_at->format('Y-m-d h:i'),
            'user' => $this->whenLoaded('user', fn () => $this->user->only('id', 'name')),
        ];
    }
}
