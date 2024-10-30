<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {

        // Создание пользователя
        $user = User::create([
            'name' => $request->name,
        ]);

        // Сохранение ID пользователя в сессии (если нужно использовать его для дальнейших действий)
        session(['user_id' => $user->id]);
    }
}
