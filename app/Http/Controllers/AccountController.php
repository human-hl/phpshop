<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Показ страницы аккаунта.
     */
    public function index()
{
    return view('account.index'); // добавляем .index
}


    /**
     * Обновление персональных данных пользователя.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($data);

        return redirect()->route('account.index')->with('success', 'Данные успешно обновлены.');
    }

    /**
     * Обновление пароля пользователя.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('account.index')->with('success', 'Пароль успешно изменён.');
    }
}
