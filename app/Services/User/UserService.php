<?php 

namespace App\Services\User;

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
    
    public static function getUserById(int $id)
    {
        return User::find($id);
    }


}