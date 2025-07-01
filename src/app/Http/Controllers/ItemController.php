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
            $query->where('name','like',"%{$search}%");
        }

        $items = $query->get();

        return view('index',compact('items','tab','search'));
    }

    public function detail(Item $item){
        return view('detail', compact('item'));
    }

    public function search(Request $request){
        $search = $request->search;
        // 検索欄に入力したキーワードを$searchが取り出す。
        $tab = $request->query('tab','recommend');
        // URLに中のtab=パラメータを取得して$tabに入れる。recommendは初期値
        $query = Item::query();
        // Itemsテーブルに対して検索を行う準備をする
        $query -> where('user_id', '<>',Auth::id());
        // ログインユーザー以外が出品した商品を表示する。
        if($tab ==='mylist'){
            $query->select('item_id')
            ->from('likes')
            ->where('user_id',auth()->id());
        }
        // ユーザがいいねした商品ID＝likesテーブル
        // 商品一覧＝Itemsテーブル
        // 例：検索欄でバックを検索し、商品一覧でバックが存在し、likesテーブルにもバックが存在していたらマイリストタブに検索結果を表示する

        if($search){
            $query->where('name','like',"%{$search}%");
        }
        // 検索キーワードが入力されていたら、商品名にキーワードを含む商品だけを検索する。
        // 例：ユーザーが「バック」と入力した時、「バック」という文字が入っている商品だけを表示する
        $items = $query->get();
        // $queryに積み重ねてきた「検索条件」や「いいね絞り込み」を実行して、実際にItemsテーブル商品を取り出す処理を行う
        return view('index',compact('items','search','tab'));
        // 'items','search','tab'の値をindex.blade.phpに渡す
    }
}

