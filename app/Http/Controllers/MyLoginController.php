<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MyLoginController extends Controller
{
    // 顯示登入頁面
    public function login(){
        return view('auth.login');
    }
    // 顯示註冊頁面
    public function register(){
        return view('auth.register');
    }
}