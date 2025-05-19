<?php

namespace App\Services;

use App\Models\User;
use App\Models\Restaurant;

class FavouriteService
{
    public function addToFavourites(User $user, int $restaurantId): bool
    {
        if ($user->favourites()->where('restaurant_id', $restaurantId)->exists()) {
            return false;
        }

        $user->favourites()->attach($restaurantId);
        return true;
    }

    public function removeFromFavourites(User $user, int $restaurantId): bool
    {
        return $user->favourites()->detach($restaurantId) > 0;
    }

    public function getUserFavouritesWithImage(int $userId)
    {
        return User::findOrFail($userId)
            ->favourites()
            ->with('mainImage')
            ->get();
    }

    public function  getFavouritesRestaurantsId(int $userId) : Array
    {
        $favouriteRestaurants = User::findOrFail($userId)
                    ->favourites()
                    ->get();
        
        $restaurantsId = [];
        foreach ($favouriteRestaurants as $favouriteRestaurant) {
            $restaurantsId[] = $favouriteRestaurant->id;
        }

        return $restaurantsId;
    }  
}