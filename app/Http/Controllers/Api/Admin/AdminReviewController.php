<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;

class AdminReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService,
    )
    {}

    /**
     * Передает все заведения
     */
    public function index() : JsonResponse 
    {
        $reviews = $this->reviewService->getReviews();

        return response()->json([
            'success' => true,
            'data' => ReviewResource::collection($reviews),
        ]);
    }

    /**
     * Удалить ресторан со всеми зависимостями
     */
    public function destroy(int $reviewId): JsonResponse
    {
        $deleted = $this->reviewService->deleteReview($reviewId);
        
        return $deleted
            ? response()->json(['success' => true])
            : response()->json(['success' => false], 404);
    }
}