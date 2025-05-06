<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->name . ' ' . $this->surname,
            'login' => $this->login,
            'avatar' => $this->src,
            'status' => (bool)$this->status,
            'last_active' => $this->last_entry,
        ];
    }
}
