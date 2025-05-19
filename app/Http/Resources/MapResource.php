<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        foreach($this->images as $image) {
            $images[] = ['src' => $image['src']];
        }

        // var_dump($this->images->image);

        return [
            'id' => $this->id,
            'coords' => [$this->coordX, $this->coordY],
            'description' => $this->description,
            'img' => $images,
        ];
    }
}
