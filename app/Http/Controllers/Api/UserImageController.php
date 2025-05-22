<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserImageRequest;
use App\Http\Requests\UpdateUserImageRequest;
use App\Http\Resources\UserImageResource;
use App\Services\UserImageService;
use Illuminate\Http\JsonResponse;

class UserImageController extends Controller
{
    public function __construct(    
        protected UserImageService $userImageService
    ) {}

    /**
     * Получить галерею пользователя
     */
    public function index(int $userId): JsonResponse
    {
        $userImages = $this->userImageService->getUserImages($userId);

        return response()->json([
            'success' => true,
            'data' => UserImageResource::collection($userImages)
        ]);
    }

    /**
     * Показать конкретное изображение
     */
    public function show(int $id): JsonResponse
    {
        $image = $this->userImageService->getImage($id);

        return $image
            ? response()->json(['success' => true, 'data' => new UserImageResource($image)])
            : response()->json(['success' => false, 'message' => 'Изображение не найдено'], 404);
    }

    /**
     * Добавить новое изображение
     */
    public function store(StoreUserImageRequest $request): JsonResponse
    {
        $image = $this->userImageService->createImage($request->validated());

        return response()->json([
            'success' => true,
            'data' => new UserImageResource($image)
        ], 201);
    }

    /**
     * Обновить изображение
     */
    public function update(UpdateUserImageRequest $request, int $id): JsonResponse
    {
        $updated = $this->userImageService->updateImage($id, $request->validated());

        return $updated
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }

    /**
     * Удалить изображение
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->userImageService->deleteImage($id);

        return $deleted
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }
}