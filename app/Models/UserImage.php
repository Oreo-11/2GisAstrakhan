<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserImage extends Model
{
    use HasFactory;

    protected $table = 'users_gallery';

    public function user() : BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
