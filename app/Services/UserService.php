<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

    /**
     * Получить всех пользователей
     */
    public static function getAllUsers(): Collection
    {
        return User::whereNot(function (Builder $query) {
            $query->where('id', 1);
            })
            ->get();
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