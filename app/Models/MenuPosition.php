<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuPosition extends Model
{
    use HasFactory;

    protected $table = 'price_list';

    public function restaraunt() : BelongsTo
    {
        return $this->belongsTo(Restaraunt::class);
    }
}
