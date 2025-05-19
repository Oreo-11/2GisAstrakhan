<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserImageController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\AdminController;


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
    Route::get('/requests', [AdminController::class, 'listAdminUnresolvedRestaurants']);
    Route::get('/users', [AdminController::class, 'listAdminUsers']);
    Route::get('/restaurants', [AdminController::class, 'listAdminRestaurants']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/active', [UserController::class, 'active']);
    Route::get('/{id}', [UserController::class, 'show']);
});

Route::prefix('users-gallery')->group(function () {
    Route::get('/user/{userId}', [UserImageController::class, 'index']);
    Route::post('/', [UserImageController::class, 'store']);
    Route::get('/{id}', [UserImageController::class, 'show']);
    Route::put('/{id}', [UserImageController::class, 'update']);
    Route::delete('/{id}', [UserImageController::class, 'destroy']);
});

Route::prefix('restaurants')->group(function (){
    Route::get('/', [RestaurantController::class, 'index']);
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
