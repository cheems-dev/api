<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'extract' => $this->extract,
            'body' => $this->body,
            'status' => ($this->status == 2) ? 'PUBLICADO' : 'BORRADOR',
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
