<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\SoldItem;
use App\Models\Profile;
use Stripe\StripeClient;

class PurchaseController extends Controller
{
    public function index($item_id, Request $request){ //$item_idは商品のURL（item/5)など
        $item = Item::find($item_id); //商品id５の商品を探して商品名や金額などのデータを$itemに入れる
        $user = User::find(Auth::id());//今、ログインしている人のID取得
        return view('purchase',compact('item','user'));
    }

    public function purchase($item_id, Request $request){
        $item = Item::find($item_id);
        $stripe = new StripeClient(config('stripe.stripe_secret_key'));
        // .envファイルに書かれているAPIキーを取得し、決済サービスを使用する準備をする

        // 変数
        [
            $user_id,
            $amount,
            $sending_postcode,
            $sending_address,
            $sending_building
        ]= [
            // 変数の説明
            Auth::id(),
            $item->price,
            $request->destination_postcode,//フォームでの値
            urlencode($request->destination_address),//urlencodeで安全な文字列
            urlencode($request->destination_building) ?? null
        ];

        // Stripeに支払いセッション（Checkout）を作成する
        $checkout_session = $stripe->checkout->session->create([
            // 支払い方法ををリクエストから受け取って指定する
            'payment_method_types' => [$request->payment_method],
            // 支払い方法の細かい設定
            'payment_method_options' => [
                // コンビニ払いなら７日以内に支払うという期限付きの設定
                'konbini' => [
                    'expires_after_days' => 7,
                ],
            ],
            // 購入する商品情報の表示
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',//円
                        'product_data' => ['name' => $item->name],//商品名
                        'unit_amount' => $item->price,//金額
                    ],
                    'quantity' => 1,//数量
                ],
            ],

            // 一度限りの支払い
            'mode' => 'payment',
            // 支払い完了後の遷移先のURLのクエリパラメータ
            'success_url' => "http://localhost/purchase/{$item_id}/success?user_id={$user_id}&amount={$amount}&sending_postcode={$sending_postcode}&sending_address={$sending_address}&sending_building={$sending_building}",
        ]);

        // 支払い完了後の遷移先のURLのクエリパラメータに遷移する
        return redirect($checkout_session->url);
    }

    // 購入確定処理
    public function success($item_id, Request $request){
        // 送信されたクエリパラメーターのURLが全部揃っているかチェック
        if(!$request->user_id || !$request->amount || !$request->sending_postcode || !$request->sending_address){
            throw new Exception("You need all Query Parameters(user_id,amount, sending_postcpde, sending_address)");
        }

        $stripe = new StripeClient(config('stripe.stripe_secret_key'));

        // Stripeで請求を作成し、実際にお金を引き落とす
        $stripe->charges->create([
            'amount' => $request->amount,//金額　（例：1000）
            'currency' => 'jpy', //円（日本円）
            'source' => 'tok_visa', //ダミーカード情報
        ]);

        //購入記録をデータベースに保存
        SoldItem::create([
            'user_id' => $request->user_id,
            'item_id' => $item_id,
            'sending_postcode' => $request->sending_postcode,
            'sending_address' => $request->sending_address,
            'sending_building' => $request->sending_building ?? null,
        ]);

        return redirect('/')->with('flashSuccess', '決済が完了しました！');
    }

    public function address($item_id, Request $request){
        $user = User::find(Auth::id());
        $profile = Profile::where('user_id', $user->id)->first();
        return view('address', compact('user', 'item_id','profile'));
    }

    public function updateAddress(AddressRequest $request){

        $user = User::find(Auth::id());
        // 　ログイン中のユーザー情報を取り出す
        Profile::where('user_id', $user->id)->update([
            // user_idに紐づいたプロフィールを探している
            'postcode' => $request->postcode,
            'address' => $request->address,
            'build' => $request->building
            // フォームから送られてきたプロフィールデータを上書きしてる
        ]);



        return redirect()->route('purchase.index', ['item_id' => $request->item_id]);
        // purchase.index（商品購入画面）のitem_idにリダイレクトする。
    }

}
