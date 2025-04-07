<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'superAdmin') {
                return redirect()->intended('/admin/main');
            } else {
                Auth::logout();
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['email' => 'У вас нет доступа']);
            }
        }


        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->withSuccess('Вы успешно вышли из системы');
    }

    public function main()
    {
        return view('admin.pages.main');
    }
}
