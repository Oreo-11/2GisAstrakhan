<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем первых 10 пользователей
        $users = User::take(10)->get();
        
        // Получаем первые 15 ресторанов
        $restaurants = Restaurant::take(15)->get();

        // Каждый пользователь добавляет в избранное 3-5 случайных ресторанов
        $users->each(function ($user) use ($restaurants) {
            $user->favourites()->attach(
                $restaurants->random(rand(3, 5))->pluck('id')
            );
        });
    }
}
