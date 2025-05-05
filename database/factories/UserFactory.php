<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Задаем модель, с которой будет связана фабрика
    protected $model = User::class;

    //Определяем тестовую структуру данных
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'),
            'age' => $this->faker->numberBetween(16, 80),
            'sex' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'src' => $this->faker->imageUrl(50, 50, 'avatars'),
            'last_entry' => $this->faker->dateTimeThisYear(), 
        ];
    }
}
