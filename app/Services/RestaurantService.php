<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService
{
    public function getRestaurants() : Collection
    {
        return Restaurant::all();
    }

    public  function getRestaurantsWithImage() : Collection
    {
        return Restaurant::where('status', true)->with('mainImage')->get();
    }

    public function getRestaurantsWithImages(): Collection
    {
        return Restaurant::where('status', true)->with('images')->get();
    }
 
}