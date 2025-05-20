<?php

namespace App\Services;

use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ReviewService
{
    public function createReview(array $data, User $user): Review
    {
        return Review::create([
            'user_id' => $user->id,
            'restaurant_id' => $data['restaurant_id'],
            'content' => $data['content'],
            'rate' => $data['rate']
        ]);
    }


    public function getRestaurantReviews(int $restaurantId, int $perPage = 10): LengthAwarePaginator
    {
        return Review::with('user:id,name,src')
            ->where('restaurant_id', $restaurantId)
            ->latest()
            ->paginate($perPage);
    }

    public function deleteReview(int $reviewId): bool
    {
        return Review::where('id', $reviewId)->delete();
    }


    // Admin
    public function getReviews() :  Collection
    {
        return Review::with('user:id,name,src')->get();
    }

    public function deleteUserReviews(int $userId) : bool
    {
        return Review::where('user_id', $userId)->delete() > 0;
    }
}