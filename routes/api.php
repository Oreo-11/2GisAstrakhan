<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserImageController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\AdminGalleryController;
use App\Http\Controllers\Api\Admin\AdminRestaurantController;
use App\Http\Controllers\Api\Admin\AdminRestaurantRequestController;
use App\Http\Controllers\Api\Admin\AdminReviewController;
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function() {
    Route::prefix('requests')->group(function() {
            Route::get('/all', [AdminRestaurantRequestController::class, 'index']);
            Route::put('/accept/{restaurant_id}', [AdminRestaurantRequestController::class, 'update']);
            Route::delete('/decline/{restaurant_id}', [AdminRestaurantRequestController::class, 'destroy']);
    });
    Route::prefix('users')->group(function() {
            Route::get('/all', [AdminUserController::class, 'index']);
            Route::put('/unban/{user_id}', [AdminUserController::class, 'update']);
    });
    Route::prefix('restaurants')->group(function() {
            Route::get('/all', [AdminRestaurantController::class, 'index']);
            Route::delete('/delete/{restaurant_id}', [AdminRestaurantController::class, 'destroy']);    
    });
    Route::prefix('reviews')->group(function() {
            Route::get('/all', [AdminReviewController::class, 'index']);
            Route::delete('/delete/{review_id}', [AdminReviewController::class, 'destroy']);    
    });
    Route::prefix('gallery')->group(function() {
            Route::get('/all', [AdminGalleryController::class, 'index']);
            Route::put('/accept/{image_id}', [AdminGalleryController::class, 'update']);
            Route::delete('/decline/{image_id}', [AdminGalleryController::class, 'destroy']);
    });
    
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/active', [UserController::class, 'active']);
    Route::get('/{id}', [UserController::class, 'show']);
});

Route::prefix('user-gallery')->group(function () {
    Route::get('/user/{userId}', [UserImageController::class, 'index']);
    Route::post('/', [UserImageController::class, 'store']);
    Route::get('/{id}', [UserImageController::class, 'show']);
    Route::put('/{id}', [UserImageController::class, 'update']);
    Route::delete('/{id}', [UserImageController::class, 'destroy']);
});

Route::prefix('gallery')->group(function (){
    Route::get('/all', [GalleryController::class, 'index']);
});

Route::prefix('restaurants')->group(function (){
    Route::get('/all', [RestaurantController::class, 'index']);
});

Route::prefix('favourites')->group(function () {
    Route::post('/{restaurant_id}', [FavouriteController::class, 'addFavourite']);
    Route::delete('/{restaurant_id}', [FavouriteController::class, 'removeFavourite']);
    Route::get('/list/id/{user_id}', [FavouriteController::class, 'listFavouritesId']);
    Route::get('/list/user/{user_id}', [FavouriteController::class, 'listFavourites']);
});

Route::prefix('map')->group(function () {
    Route::get('/', [MapController::class, 'index']);
});

Route::prefix('restaurants/{restaurant_id}/reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/', [ReviewController::class, 'store']);
    Route::delete('/{review}', [ReviewController::class, 'destroy']);
    
});
