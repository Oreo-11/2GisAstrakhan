<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminRestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $reviewsCount = count($this->reviews);

        return [
            'name' => $this->title,
            'src' => $this->mainImage->src,
            'description' => $this->description,
            'address' => $this->address,
            'averagePrice' => $this->average_price,
            'reviewsCount' => $reviewsCount,
            'rating' => $this->rating,
        ];
    }
}
