<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminRestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;

class AdminRestaurantController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService,
    )
    {}

    /**
     * Передает все заведения
     */
    public function index() : JsonResponse 
    {
        $restaurantRequests = $this->restaurantService->getRestaurantRequests();

        return response()->json([
            'success' => true,
            'data' => AdminRestaurantResource::collection($restaurantRequests),
        ]);
    }

    /**
     * Удалить ресторан со всеми зависимостями
     */
    public function destroy(int $restaurantId): JsonResponse
    {
        $deleted = $this->restaurantService->deleteRestaurant($restaurantId);
        
        return $deleted
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }
}
