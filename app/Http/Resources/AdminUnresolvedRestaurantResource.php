<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUnresolvedRestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => "$this->owner_surname $this->owner_name $this->owner_patronymic",
            'mail' => $this->restaurant_mail,
            'number' => $this->phone,
            'address' => $this->address,
            'barName' => $this->title,
            'INN' => $this->INN,
            'KPP' => $this->KPP,
            'OGRN' => $this->OGRN,
            'telegram' => $this->telegram_url,
            'whatsapp' => $this->whatsapp_url,
            'vk' => $this->vk_url,
        ];
    }
}