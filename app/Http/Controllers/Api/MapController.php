<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MapResource;
use App\Services\RestaurantService;

class MapController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService
    )
    {}

    public function index() : JsonResponse
    {
        $restaurants = $this->restaurantService->getRestaurantsWithImages();

        return response()->json([
            'success' => true,
            'data' => MapResource::collection($restaurants),
            // 'data' => $restaurants,
        ]);
    }    
}
