<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
//ログインログアウトなどを扱うためのAuthファザーどをインポートする
use App\Http\Requests\CommentRequest;
use App\Models\comment;

class CommentController extends Controller
{
    public function create($item_id, CommentRequest $request)
    {
        $comment = new Comment();
        // Commentモデルに対するデータの入れ物を作成
        $comment->user_id = Auth::id();
        // ログイン中のユーザーがどのコメントの投稿者ということを特定する
        $comment->item_id = $item_id;
        // このコメントはどの商品IDに対してのコメントなのかを特定する
        $comment->comment = $request->comment;
        // フォームでのコメントの内容をcommentモデルに詰め込む
        $comment->save();
        // commentsテーブルに挿入する

        return back()->with('flashSuccess', 'コメントを送信しました！');;
        // 前のページにリダイレクトし、メッセージを表示する
    }
}
