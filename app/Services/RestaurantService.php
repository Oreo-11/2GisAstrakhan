<?php

namespace App\Services;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\RestaurantImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService
{
    public function createRestaurant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Фамилия-владельца' => 'required|min:3',
            'Имя-владельца' => 'required|min:3',
            'Отчество-владельца' => 'required|min:3',
            'restaurant_mail' => 'required|email|unique:restaurants',
            'Наименование' => 'required|min:3',
            'Телефон' => 'required|min:11',
            'Адрес' => 'required',
            'INN' => 'required|unique:restaurants',
            'KPP' => 'required|unique:restaurants',
            'OGRN' => 'required|unique:restaurants',
            'startTimeWork' => 'required',
            'endTimeWork' => 'required',
            'telegram' => '',
            'WhatsApp' => '',
            'VK' => '',
            'description' => 'required',
        ], $messages = [
            'required' => 'Поле \':attribute\' должна быть заполнена',
            'unique' => 'Такое значение уже есть',
            'email' => 'Введите поле \':attribute\' по примеру example@gmail.com',
            'min' => 'Поле \':attribute\' должно содержать не менее :min символов'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'message' => 'NotSuccess',
                'surnameOwner' => $errors->first('Фамилия владельца'),
                'nameOwner' => $errors->first('Имя владельца'),
                'patronymicOwner' => $errors->first('Отчество владельца'),
                'restaurant_mail' => $errors->first('restaurant_mail'),
                'nameRestourant' => $errors->first('Наименование'),
                'phone' => $errors->first('Телефон'),
                'address' => $errors->first('Адрес'),
                'INN' => $errors->first('INN'),
                'KPP' => $errors->first('KPP'),
                'OGRN' => $errors->first('OGRN'),
                'worktime_start' => $errors->first('startTimeWork'),
                'worktime_end' => $errors->first('endTimeWork'),
                'telegram' => $errors->first('telegram'),
                'WhatsApp' => $errors->first('WhatsApp'),
                'VK' => $errors->first('VK'),
                'description' => $errors->first('description'),
            ], 403);
        }

        $restaurant = Restaurant::create([
            'owner_name' => $request->input('Фамилия-владельца'),
            'owner_surname' => $request->input('Имя-владельца'),
            'owner_patronymic' => $request->input('Отчество-владельца'),
            'restaurant_mail' => $request->input('restaurant_mail'),
            'title' => $request->input('Наименование'),
            'phone' => $request->input('Телефон'),
            'address' => $request->input('Адрес'),
            'INN' => $request->input('INN'),
            "KPP" => $request->input('KPP'),
            'OGRN' => $request->input('OGRN'),
            'worktime_start' => $request->input('startTimeWork'),
            'worktime_end' => $request->input('endTimeWork'),
            'telegram_url' => $request->input('Telegram'),
            'whatsapp_url' => $request->input('WhatsApp'),
            'vk_url' => $request->input('VK'),
            'description' => $request->input('description'),
            'restaurant_site_url' => "",
            'average_price' => 0,
            'coordX' => $request->input('coordX'),
            'coordY' => $request->input('coordY'),
            'status' => 0,
            'rating' => 0,
        ]);

        $restaurant->save();

        // Валидация файлов
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:20480'
        ]);

        // Проверяем, есть ли файлы для загрузки
        if (!$request->hasFile('files')) {
            return response()->json(['error' => 'No files uploaded'], 400);
        }

        $uploadedFiles = [];

        // Обрабатываем каждый файл
        foreach ($request->file('files') as $file) {
            // Генерируем уникальное имя файла
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Сохраняем файл в storage/app/public/uploads
            $path = $file->storeAs('public/assets/images', $fileName);

            // Сохраняем информацию о файле
            $uploadedFiles[] = [
                'original_name' => $file->getClientOriginalName(),
                'stored_name' => $fileName,
                'path' => Storage::url($path),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ];
        }

        foreach ($uploadedFiles as $files) {
            $new_img = RestaurantImage::create([
                'restaurant_id' => $restaurant->id,
                'src' => $files["path"]
            ]);
            $new_img->save();
        }

        return response()->json([
            'Success' => true,
            'message' => 'Success add restaurant',
        ], 200);
    }


    public function getAllRestaurants(): Collection
    {
        return Restaurant::all();
    }

    public function getRestaurantsWithImage() : Collection
    {
        return Restaurant::where('status', true)->with('mainImage')->get();
    }

    public function getRestaurantsWithImages(): Collection
    {
        return Restaurant::where('status', true)->with('images')->get();
    }

    public function deleteRestaurant(int $restaurantId): bool
    {
        return Restaurant::deleteWithRelations($restaurantId);
    }


    //Admin

    public function getRestaurantRequests(): Collection
    {
        return Restaurant::where('status', false)->get();
    }

    public function acceptRestaurantRequest(int $restaurantId): bool
    {
        return Restaurant::where('id', $restaurantId)->update(['status' => true]);
    }

    public function declineRestaurantRequest(int $restaurantId): bool
    {
        return Restaurant::destroy($restaurantId);
    }


    public function getRestaurantsWithImageAdmin(): Collection
    {
        return Restaurant::where('status', true)
            ->with('mainImage')
            ->with('reviews')
            ->get();
    }
}
