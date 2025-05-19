<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => "$this->surname $this->name $this->patronymic",
            'status' => $this->status,
            'reason' => $this->reason,
            'src' => $this->src,
            'email' => $this->email,
        ];
    }
}
