<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\User\UserService;

class UserController extends Controller
{
    /**
     * Получает пользователя по id
     */
    public function getUserById (int $id) 
    {
        $user = UserService::getUserById($id);

        return $user
            ? response()->json(['data' => $user], 200)
            : response()->json(['error' => 'Пользователь не найден'], 404);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
