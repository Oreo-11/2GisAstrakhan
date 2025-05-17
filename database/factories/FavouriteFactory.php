<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favourite>
 */
class FavouriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Для конкретного пользователя.
     */
    public function forUser(int $userId): static
    {
        return $this->state(fn () => [
            'user_id' => $userId,
        ]);
    }

    /**
     * Для конкретного ресторана.
     */
    public function forRestaurant(int $restaurantId): static
    {
        return $this->state(fn () => [
            'restaurant_id' => $restaurantId,
        ]);
    }
}
