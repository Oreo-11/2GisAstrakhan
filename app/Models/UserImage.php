<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserImage extends Model
{
    use HasFactory;

    public $timestamps = false; // Отключаем timestamps

    protected $fillable = [
        'user_id', 
        'description', 
        'src' 
    ];

    public function user() : BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
