<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//ログインユーザーの情報や認証操作を扱う
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\CategoryItem;

class ItemController extends Controller
{
    public function index(Request $request){ //商品一覧
        $tab = $request->query('tab', 'recommend');
        //「おすすめ」か「マイリスト」のタブの表示を切り替える
        $search = $request->query('search');
        // 商品検索のキーワードを受け取る
        $query = Item::query();
        // Itemモデルを使用してDBから情報を取り出す準備をする
        $query->where('user_id', '<>', Auth::id());
        // ログイン中の自分の出品した商品は除外する

        if ($tab === 'mylist'){
            // もし、URLでタブがマイリストだったら
            $query->whereIn('id', function ($query) {
                // 「マイリスト」を表示するときにlikesテーブルから自分が「いいね」をした商品だけを集めて一覧にする
                $query->select('item_id')
                    ->from('likes')
                    ->where('user_id', auth()->id());
            });
        }

        if($search){
            $query->where('name','like',"%{search}%");
        }

        $items = $query->get();

        return view('index',compact('items','tab','search'));
    }

    public function detail(Item $item){
        return view('detail', compact('item'));
    }

    public function search(Request $request){
        $search_word = $request->search;
        // 検索フォームの<input name="search_item">から送られてきた値を$search_wordに代入
        $query = Item::query();
        // Itemモデルのクエリビルダ（PHPを使用してSQL文を構築する仕組み）を作成する
        $query = Item::scopeItem($query, $search_word);
        // ItemモデルのscopeItemメソッドと繋がっていて、$search_wordを使用してクエリに検索条件を追加している

        $items = $query->get();
        //商品を検索し、該当する商品データを取得する
        return view('index', compact('items'));
    }
}