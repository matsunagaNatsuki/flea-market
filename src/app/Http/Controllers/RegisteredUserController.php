<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

class RegisteredUserController extends Controller
{
    public function store(Request $request,CreateNewUser $creator)
    // Request=フォームから送られてきた情報を受け取る
    // CreateNewUser＝Fortifyでユーザーの作成を行う
    {
        event(new Registered($user = $creator->create($request->all())));
        // ユーザーからのリクエストを受け取り、新しいユーザーを作成する
        session()->put('unauthenticated_user', $user);
        // 登録は完了してるけど、メール認証されていないユーザをセッションに記録する
        return redirect()->route('verification.notice');
    }
}

