<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserImageService;
use Illuminate\Http\JsonResponse;

class AdminGalleryController extends Controller
{
    public function __construct(
        protected UserImageService $userImageService,
    )
    {}

    /**
     * Передает заведения с status = false
     */
    public function index() : JsonResponse 
    {
        $images = $this->userImageService->getUnresolvedUsersImages();

        return response()->json([
            'success' => true,
            'data' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $imageId): JsonResponse
    {
        $updated = $this->userImageService->acceptUserImage($imageId);

        return $updated
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $imageId)
    {
        $deleted = $this->userImageService->declineUserImage($imageId);

        return $deleted
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }
}
