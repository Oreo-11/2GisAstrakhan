<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class RestaurantSortingService
{

    public function getRestaurantsWithImage(string $sortingType) : Collection
    {
        $query = Restaurant::query()
            ->where('status', true)
            ->with('mainImage')
            ->withCount('reviews');
        

        $this->selectTypeOfSorting($sortingType, $query);

        $restaurants = $query->get();

        return $restaurants;
    }

    private function selectTypeOfSorting($sortingType, $query) : void
    {
        $direction = ['asc', 'desc'];
        $sortingTypes = [
            'nameSorting' => ['title', $direction[0]], 
            'averagePriceSorting' => ['average_price', $direction[0]],
            'ratingSorting' => ['rating', $direction[1]],
            'countReviewsSorting' => ['reviews_count', $direction[1]],
        ];

        if (array_key_exists($sortingType, $sortingTypes)) {
            $query->orderBy($sortingTypes[$sortingType][0], $sortingTypes[$sortingType][1]);
        }
        else {
            $query->orderBy('id', 'asc');
        }
    }

}