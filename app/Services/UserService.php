<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

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
    public function getActiveUsers() : Collection
    {
        return User::where('status', 1)->get();
    }

    public function deleteUser(int $userId) : bool 
    {
        return User::where('id', $userId)->delete();
    }



    // Admin

    public function getAllUsers() : Collection
    {
        return User::whereNot(function (Builder $query) {
            $query->where('id', 1);
            })
            ->get();
    }

    public function unbanUser(int $userId) : bool
    {
        return User::where('id', $userId)->update(['status' => true]);
    }

    public function banUser(int $userId) : bool
    {
        return User::where('id', $userId)->update(['status' => false]);
    }
}