<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register()
    {
        //验证
        $this->validate(\request(), [
            'name' => 'required|min:1|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:3|max:12|confirmed'
        ]);
        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));

        User::create(compact('name', 'email', 'password'));
        //渲染视图
        return redirect('/login');
    }
}
