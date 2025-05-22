<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Регистрация
     */
    public static function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Имя' => 'required|min:3',
            'Фамилия' => 'required|min:3',
            'age' => 'required',
            'login' => 'required|unique:users|email',
            'Пароль' => 'required|min:5',
            'sex' => 'required'
        ], $messages = [
            'required' => 'Поле \':attribute\' должна быть заполнена',
            'unique' => 'Такой email уже есть',
            'email' => 'Введите поле \':attribute\' по примеру example@gmail.com',
            'min' => 'Поле \':attribute\' должно содержать не менее :min символов'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'message' => 'NotSuccess',
                'name' => $errors->first('Имя'),
                'surname' => $errors->first('Фамилия'),
                'login' => $errors->first('email'),
                'password' => $errors->first('Пароль'),
            ], 403);
        }

        $user = User::create([
            'name' => $request->Имя,
            'surname' => $request->Фамилия,
            'login' => $request->login,
            'password' => Hash::make($request->Пароль),
            'sex' => 1,
            'status' => 0,
            'age' => $request->age,
            'src' => "нету",
            "last_entry" => "2025-05-22 13:22:44.000000"
        ]);

        $token = $user->createToken('user_token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'token' => $token,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'email' => $user->email
        ], 200);
    }

    /**
     * Авторизация
     */
    public static function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|email',
            'Пароль' => 'required|min:6',
        ], $messages = [
            'required' => 'Поле \':attribute\' должна быть заполнена',
            'unique' => 'Такой login уже есть',
            'email' => 'Введите поле \':attribute\' по примеру example@gmail.com',
            'min' => 'Поле \':attribute\' должно содержать не менее :min символов'
        ]);

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'NotSuccess',
        //         'email' => $errors->first('email'),
        //         'password' => $errors->first('Пароль'),
        //     ], 403);
        // }

        $user = User::where('login', '=', trim($request->input('login')))->firstOrFail();

        if (Hash::check(trim($request->input('Пароль')), $user->password)) {
            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => "Success",
                'token' => $token,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'email' => $user->email,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Login failed"
            ], 401);
        }
    }


    /**
     * Получить пользователя по ID
     */
    public static function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Получить активных пользователей
     */
    public function getActiveUsers(): Collection
    {
        return User::where('status', 1)->get();
    }

    public function deleteUser(int $userId) : bool 
    {
        return User::where('id', $userId)->delete();
    }



    // Admin

    public function getAllUsers() : Collection
    {
        return User::whereNot(function (Builder $query) {
            $query->where('id', 1);
            })
            ->get();
    }

    public function unbanUser(int $userId) : bool
    {
        return User::where('id', $userId)->update(['status' => true]);
    }

    public function banUser(int $userId) : bool
    {
        return User::where('id', $userId)->update(['status' => false]);
    }
}
