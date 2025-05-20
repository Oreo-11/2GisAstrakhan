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

    public  function getRestaurantsWithImage() : Collection
    {
        return Restaurant::where('status', true)->with('mainImage')->get();
    }

    public function getRestaurantsWithImages() : Collection
    {
        return Restaurant::where('status', true)->with('images')->get();
    }
    
    public function deleteRestaurant(int $restaurantId): bool
    {        
        return Restaurant::deleteWithRelations($restaurantId);
    }


    //Admin

    public function getRestaurantRequests() : Collection
    {
        return Restaurant::where('status', false)->get();
    }

    public function acceptRestaurantRequest(int $restaurantId): bool
    {
        return Restaurant::where('id', $restaurantId)->update(['status' => true]);
    }

    public function declineRestaurantRequest(int $restaurantId): bool
    {
        return Restaurant::destroy($restaurantId);
    }


    public function getRestaurantsWithImageAdmin() : Collection
    {
        return Restaurant::where('status', true)
                            ->with('mainImage')
                            ->with('reviews')
                            ->get();
    }

    
}