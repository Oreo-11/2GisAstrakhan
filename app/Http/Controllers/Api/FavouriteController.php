<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Models\User;
use App\Services\FavouriteService;
use Illuminate\Http\JsonResponse;


class FavouriteController extends Controller
{
    public function __construct(
        protected FavouriteService $favouriteService,
        protected User $user
    ) {}

    public function addFavourite(int $restaurantId): JsonResponse
    {
        $result = $this->favouriteService->addToFavourites($this->user, $restaurantId);

        return $result
            ? response()->json(['success' => true])
            : response()->json(['success' => false, 'message' => 'Уже в избранном'], 400);
    }

    public function removeFavourite(int $restaurantId): JsonResponse
    {
        $result = $this->favouriteService->removeFromFavourites($this->user, $restaurantId);

        return response()->json(['success' => (bool)$result]);
    }

    public function listFavourites(int $userId): JsonResponse
    {
        $favourites = $this->favouriteService->getUserFavouritesWithImage($userId);

        return response()->json([
            'success' => true,
            'data' => RestaurantResource::collection($favourites)
        ]);
    }

    public function listFavouritesId(int $userId) : JsonResponse
    {
        $favouritesId  = $this->favouriteService->getFavouritesRestaurantsId($userId);

        return response()->json([
            'success' => true,
            'data' => $favouritesId,
        ]);
    }
}
