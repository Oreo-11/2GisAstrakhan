<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    public $timestamps = false; // Отключаем timestamps

    public function image() : HasMany
    {
        return $this->hasMany(UserImage::class);
    }

    public function favourites() : BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'favourites');
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public static function deleteWithRelations(int $id): bool
    {
        $user = self::with(['favourites', 'reviews', 'image'])->find($id);
        
        if (!$user) {
            return false;
        }

        // Удаляем все связи
        $user->favourites()->detach();
        
        // Удаляем связанные записи
        $user->reviews()->delete();
        $user->image()->delete();
        
        // Удаляем пользователя
        return $user->delete();
    }
}
