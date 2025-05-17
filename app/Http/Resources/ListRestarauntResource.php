<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListRestaurantResource extends JsonResource // Массив для вывода карточки ресторана
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * 
     */
    public function toArray(Request $request): array
    {
        return [
            
        ];
    }
}
