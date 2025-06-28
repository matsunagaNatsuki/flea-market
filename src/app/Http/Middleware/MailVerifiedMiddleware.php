<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MailVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        $session_data = session()->get('unauthenticated_user') ?? null;
        // 未認証ユーザーの情報がセッションにあるか調べて、セッションが存在していれば処理を止める。（セッションが存在しているってことは認証されていないユーザだから処理を止める。）

        if($session_data){
            return redirect()->route('verification.notice');
        }
        // もし、$session_dataが存在すればverification.noticeという名前のルートにリダイレクトする

        return $next($request);
        // リクエストを次のミドルウェアやコントローラーに渡す
    }
}
