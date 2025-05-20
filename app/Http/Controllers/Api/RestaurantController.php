<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteResource;
use App\Models\User;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantResource;

class RestaurantController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService,
        protected User $user
    ) {}

    public function createRestaurant(Request $request): JsonResponse
    {
        $result = $this->restaurantService->createRestaurant($request);

        return response()->json([
            'success' => $result,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $restaurants = $this->restaurantService->getRestaurantsWithImage();

        return response()->json([
            'success' => true,
            'data' => RestaurantResource::collection($restaurants),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
