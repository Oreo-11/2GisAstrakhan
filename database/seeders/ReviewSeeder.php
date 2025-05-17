<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Для каждого ресторана создаем 5-10 отзывов
        Restaurant::each(function (Restaurant $restaurant) {
            Review::factory()
                ->count(rand(5, 10))
                ->forRestaurant($restaurant->id)
                ->create();
        });
    }
}
