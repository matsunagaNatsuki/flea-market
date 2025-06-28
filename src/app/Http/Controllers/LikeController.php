<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // いいねをつける
    public function create($item_id,Request $request){
        Like::create([
            // Likeモデルを使用して「いいね」データを作成
            'user_id' => Auth::id(),
            // ログイン中のユーザーのIDを取得
            'item_id' => $item_id
            // 「いいね」を押された商品ID
        ]);
        return back();
        // ユーザを直前のページ（商品詳細）に戻す
    }

    // いいねを取り消す
    public function destroy($item_id, Request $request){
        Like::where(['user_id' => Auth::id(), 'item_id' => $item_id])->delete();
        // ログイン中のユーザーががとう商品に付けた「いいね」レコードを検索し、「いいね」を取り消している
        return back();
    }
}
