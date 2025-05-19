<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUnresolvedRestaurantResource;
use App\Http\Resources\AdminRestaurantResource;
use App\Http\Resources\AdminUserResource;
use App\Services\RestaurantService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        protected RestaurantService $restaurantService,
        protected UserService $userService,
    )
    {}

    /**
     * Передает заведения с status = false
     */
    public function listAdminUnresolvedRestaurants() : JsonResponse 
    {
        $unresolvedRestaurants = $this->restaurantService->getUnresolvedRestaurants();

        return response()->json([
            'success' => true,
            'data' => AdminUnresolvedRestaurantResource::collection($unresolvedRestaurants),
        ]);
    }

    /**
     * 
     */
    public function listAdminUsers() : JsonResponse 
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'success' => true,
            'data' => AdminUserResource::collection($users),
        ]);
    }
    
    public function listAdminRestaurants() : JsonResponse
    {
        $restaurants = $this->restaurantService->getRestaurantsWithImageAdmin();

        return response()->json([
            'success' => true,
            'data' => AdminRestaurantResource::collection($restaurants),
        ]);
    }
}
