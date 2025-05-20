<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Restaurant extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function images() : HasMany
    {
        return $this->hasMany(RestaurantImage::class);
    }
    
    public function favouritedBy() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function mainImage() : HasOne
    {
        return $this->hasOne(RestaurantImage::class)->oldestOfMany();
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Расчет рейтинга
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rate') ?? 0;
    }

    /**
     * Удаление ресторана со всеми связанными записями
     */
    public static function deleteWithRelations(int $id): bool
    {
        $restaurant = self::with(['reviews', 'images', 'favouritedBy'])->find($id);
        
        if (!$restaurant) {
            return false;
        }

        // Удаляем все связи
        $restaurant->favouritedBy()->detach();
        
        // Удаляем связанные записи
        $restaurant->reviews()->delete();
        $restaurant->images()->delete();
        
        // Удаляем сам ресторан
        return $restaurant->delete();
    }


    // public function menuList(): HasMany
    // {
    //     return $this->hasMany(MenuPosition::class);
    // }

    
}
