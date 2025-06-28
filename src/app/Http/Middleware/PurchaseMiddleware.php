<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\SoldItem;

class PurchaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $param = $request->route()->parameter('item_id');
        // 現在のURLルートの中からパラメータ（商品ID）を取得している
        // 例：/purchase/23のURLなら$paramに２３が入る

        $item = Item::find($param);
        // データベースのItemsテーブルを見て該当商品を探して$itemに入れる
        if($item->user_id == Auth::id()){
            // 商品の出品者IDとログイン中のIDが同じかチェック
            // もし、出品者ならitem,detailにリダイレクト（商品詳細画面に戻す）
            return redirect()->route('item.detail',['item' => $request->item_id])->with('flash_alert', '出品者が購入することはできません');
        }

        return $next($request);
        // 出品者なら次の処理（コントローラなど）へリクエストを流す
    }
}
