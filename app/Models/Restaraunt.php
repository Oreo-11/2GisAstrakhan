<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaraunt extends Model
{
    use HasFactory;

    public function images() : HasMany
    {
        return $this->hasMany(RestarauntImage::class);
    }

    public function menuList(): HasMany
    {
        return $this->hasMany(MenuPosition::class);
    }

    
}
