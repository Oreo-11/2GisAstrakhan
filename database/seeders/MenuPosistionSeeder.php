<?php

namespace Database\Seeders;

use App\Models\MenuPosition;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuPosistionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::all()->each(function ($restaurant) {
            MenuPosition::factory(rand(3, 5))->create([
                'restaurant_id' => $restaurant->id,
            ]);
        });
    }
}
