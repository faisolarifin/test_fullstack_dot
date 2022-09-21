<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class Login extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('login');
    }

    public function actionLogin(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('index');
        }
        return redirect()->route('login')->with('error', 'Email atau Password Salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
