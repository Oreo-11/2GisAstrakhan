<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\RestaurantImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RestaurantImage>
 */
class RestaurantImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RestaurantImage::class;
    
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id ?? Restaurant::factory()->create()->id,
            'src' => $this->faker->imageUrl(640, 480, 'restaurant', true) ?: 'https://default.image.url',
        ];
    }
}
