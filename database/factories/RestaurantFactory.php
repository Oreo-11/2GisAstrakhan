<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Restaurant::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'description' => $this->faker->paragraph(3) ?: 'Default description',
            'worktime_start' => $this->faker->time(),
            'worktime_end' => $this->faker->time(),
            'phone' => $this->faker->numerify('+7 (8512) ###-##-##'),
            'Restaurant_site_url' => $this->faker->url(),
            'address' => $this->faker->address(),
            'average_price' => $this->faker->numberBetween(500, 1000),
            'coordX' => $this->faker->randomFloat(4),
            'coordY' => $this->faker->randomFloat(4),
            'owner_name'=> $this->faker->firstName(),
            'owner_surname'=> $this->faker->lastName(),
            'owner_patronymic'=> $this->faker->firstName('male'),
            'restaurant_mail' => $this->faker->companyEmail(),
            'INN' => $this->faker->numerify('##########'),
            'KPP' => $this->faker->numerify('#########'),
            'OGRN' => $this->faker->numerify('#############'),
            'telegram_url' => $this->faker->url(),
            'whatsapp_url' => $this->faker->url(),
            'vk_url' => $this->faker->url(),
            'status' => $this->faker->boolean(),
            'rating' => $this->faker->randomFloat(1, 1, 4),
        ];
    }
}
