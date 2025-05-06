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
        return $this->belongsToMany(Restaraunt::class, 'users_favourite_restaraunts', 'user_id', 'restaraunt_id');
    }
}
