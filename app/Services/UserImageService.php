<?php

namespace App\Services;

use App\Models\UserImage;
use Illuminate\Database\Eloquent\Collection;

class UserImageService
{
    /**
     * Получить все изображения пользователя
     */
    public function getUserImages(int $userId): Collection
    {
        return UserImage::where('user_id', $userId)
                            ->where('status', true)
                            ->get();
    }

    /**
     * Получить конкретное изображение с данными пользователя
     */
    public function getImage(int $id): ?UserImage
    {
        return UserImage::where('status', true)
                            ->with('user:id,name,src')
                            ->find($id);
    }

    /**
     * Создать новое изображение
     */
    public function createImage(array $data): UserImage
    {
        return UserImage::create($data);
    }

    /**
     * Обновить изображение
     */
    public function updateImage(int $id, array $data): bool
    {
        return UserImage::where('id', $id)->update($data);
    }

    /**
     * Удалить изображение
     */
    public function deleteImage(int $id): bool
    {
        return UserImage::destroy($id);
    }

    
    // Admin

    public function getUnresolvedUsersImages() : Collection
    {
        return UserImage::where('status', false)->get();
    }

    public function acceptUserImage(int $imageId): bool
    {
        return UserImage::where('id', $imageId)->update(['status' => true]);
    }

    public function declineUserImage(int $imageId): bool
    {
        return UserImage::destroy($imageId);
    }
}