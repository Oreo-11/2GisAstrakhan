<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Restaurant extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function images() : HasMany
    {
        return $this->hasMany(RestaurantImage::class);
    }
    
    public function favouritedBy() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function mainImage() : HasOne
    {
        return $this->hasOne(RestaurantImage::class)->oldestOfMany();
    }

    // public function menuList(): HasMany
    // {
    //     return $this->hasMany(MenuPosition::class);
    // }

    
}
