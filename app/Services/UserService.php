<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

    /**
     * Получить всех пользователей
     */
    public static function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Получить пользователя по ID
     */
    public static function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Получить активных пользователей
     */
    public function getActiveUsers(): Collection
    {
        return User::where('status', 1)->get();
    }

}