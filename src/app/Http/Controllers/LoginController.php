<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが間違っています'
            ]);
        }

        return redirect('/mypage/profile');
    }

}
