<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserImageController;
use App\Http\Controllers\Api\FavouriteController;

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

Route::prefix('favourites')->group(function () {
    Route::post('/{restaurant}', [FavouriteController::class, 'addFavourite']);
    Route::delete('/{restaurant}', [FavouriteController::class, 'removeFavourite']);
    Route::get('/list/{user_id}', [FavouriteController::class, 'listFavourites']);
});
