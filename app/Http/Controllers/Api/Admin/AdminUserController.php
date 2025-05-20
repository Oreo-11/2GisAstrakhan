<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AdminUserController extends Controller
{
    public function __construct(
        protected UserService $userService,
    )
    {}

    /**
     * Передает всех пользователей
     */
    public function index() : JsonResponse 
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'success' => true,
            'data' => AdminUserResource::collection($users),
        ]);
    }

    /**
     * Разблокирует пользователя
     */
    public function unbanUser(int $userId) : JsonResponse
    {
        $updated = $this->userService->unbanUser($userId);

        return $updated
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }

    public function banUser(int $userId) : JsonResponse
    {
        $updated = $this->userService->banUser($userId);

        return $updated
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $restaurantId)
    {
        // $deleted = $this->restaurantService->declineRestaurantRequest($restaurantId);

        // return $deleted
        //     ? response()->json(['success' => true])
        //     : response()->json(['success' => false], 404);
    }
}