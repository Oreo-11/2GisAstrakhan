<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\UserService;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Получить всех пользователей
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users),
            'message' => 'Пользователи отправлены'
        ]);
    }

    /**
     * Получить конкретного пользователя
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Пользователь не найден'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Пользователь успешно отправлен'
        ]);
    }

    /**
     * Получить только активных пользователей
     */
    public function active(): JsonResponse
    {
        $users = $this->userService->getActiveUsers();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Активные пользователи успешно отправлены'
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
