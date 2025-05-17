<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\RestaurantImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::all()->each(function ($restaurant) {
            RestaurantImage::factory(rand(3, 5))->create([
                'restaurant_id' => $restaurant->id,
            ]);
        });
    }
}
