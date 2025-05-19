<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService
{
    public function getAllRestaurants() : Collection
    {
        return Restaurant::all();
    }

    public function getUnresolvedRestaurants() : Collection
    {
        return Restaurant::where('status', false)->get();
    }

    public  function getRestaurantsWithImage() : Collection
    {
        return Restaurant::where('status', true)->with('mainImage')->get();
    }

    public function getRestaurantsWithImages() : Collection
    {
        return Restaurant::where('status', true)->with('images')->get();
    }

    public function getRestaurantsWithImageAdmin() : Collection
    {
        return Restaurant::where('status', true)
                            ->with('mainImage')
                            ->with('reviews')
                            ->get();
    }
 
}