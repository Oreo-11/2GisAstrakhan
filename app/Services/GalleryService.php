<?php

namespace App\Services;

use App\Models\UserImage;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;

class GalleryService
{
    /**
     * Получить изображения в случайном порядке
     */
    public function getRandomImages() : CursorPaginator
    {
        return UserImage::query()
                ->where('status', true)
                ->with('user:id,name,src')
                ->inRandomOrder()
                ->cursorPaginate(15);
    }
}