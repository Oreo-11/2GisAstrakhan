<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем тестового админа
        User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Adminov',
            'patronymic' => 'Adminovich',
            'login' => 'admin',
            'password' => bcrypt('admin123'),
            'email' => 'admin@mail.ru',
            'status' => true,
            'reason' => '',
            'src' => 'https://example.com/admin-avatar.jpg',
        ]);

        // Создаем 10 случайных пользователей
        User::factory(10)->create();
    }
}
