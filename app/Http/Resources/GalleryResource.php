<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'user_id' => $this->user_id,
            'description' => $this->description,
            'image_url' => $this->src,
            'user' => [
                'name' => $this->user->name,
                'avatar' => $this->user->src
            ],
            'next_cursor' => $this->when($this->id, function() {
                return base64_encode(json_encode(['id' => $this->id]));
            })
        ];    
    }
}
