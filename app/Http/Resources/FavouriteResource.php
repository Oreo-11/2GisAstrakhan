<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
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
            'rate' => $this->rating,
            'src' => $this->mainImage->src,
            'title' => $this->title,
            'street' => $this->address,
            'averagePrice' => $this->average_price,
            'description' => $this->description,
        ];
    }
}
