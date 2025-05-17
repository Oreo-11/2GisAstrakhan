<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\UserImage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserImage>
 */
class UserImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserImage::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'description' => $this->faker->sentence(6) ?: 'Default description',
            'src' => $this->faker->imageUrl(640, 480, 'nature', true) ?: 'https://default.image.url',
        ];
    }
}
