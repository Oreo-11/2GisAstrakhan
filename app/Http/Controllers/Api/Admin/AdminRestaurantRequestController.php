<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminRestaurantRequestResource;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;

class AdminRestaurantRequestController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService,
    )
    {}

    /**
     * Передает заведения с status = false
     */
    public function index() : JsonResponse 
    {
        $restaurantRequests = $this->restaurantService->getRestaurantRequests();

        return response()->json([
            'success' => true,
            'data' => AdminRestaurantRequestResource::collection($restaurantRequests),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $restaurantId): JsonResponse
    {
        $updated = $this->restaurantService->acceptRestaurantRequest($restaurantId);

        return $updated
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $restaurantId)
    {
        $deleted = $this->restaurantService->declineRestaurantRequest($restaurantId);

        return $deleted
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }
}
