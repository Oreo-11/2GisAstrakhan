<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'content' => $this->faker->paragraph(3),
            'rate' => $this->faker->numberBetween(1, 5),
        ];
    }


    /**
     * Указание конкретного объекта, но фукнцию state не понял
     */
    public function forRestaurant(int $restaurantId): static
    {
        return $this->state(fn (array $attributes) => [
            'restaurant_id' => $restaurantId,
        ]);
    }

    public function forUser(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }
}
