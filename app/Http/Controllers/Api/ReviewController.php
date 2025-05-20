<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Restaurant;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function store(StoreReviewRequest $request): JsonResponse
    {
        $review = $this->reviewService->createReview(
            $request->validated(), 
            Auth::user()
        );

        return response()->json([
            'success' => true,
            'data' => new ReviewResource($review)
        ], 201);
    }

    public function index(int $restaurantId): JsonResponse
    {
        $reviews = $this->reviewService->getRestaurantReviews($restaurantId);
        
        return response()->json([
            'success' => true,
            'average_rating' => Restaurant::find($restaurantId)->averageRating(),
            'data' => ReviewResource::collection($reviews),
            'meta' => [
                'total' => $reviews->total(),
                'current_page' => $reviews->currentPage()
            ]
        ]);
    }

    public function destroy(int $reviewId): JsonResponse
    {
        $success = $this->reviewService->deleteReview($reviewId, Auth::id());

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Review deleted' : 'Review not found'
        ]);
    }
}
