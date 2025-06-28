<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;
use App\Models\Item;
use App\Models\SoldItem;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(){

        $profile = Profile::where('user_id', Auth::id())->first();

        return view('profile',compact('profile'));
    }

    public function updateProfile(ProfileRequest $request){

        $img = $request->file('img_url');//画像ファイルを取得
        if (isset($img)){
            $img_url = Storage::disk('local')->put('public/img', $img);
        }else{
            $img_url = '';
        }
        //もし、画像送られてきてれば、画像をstorage/app/public/imgに保存して保存後、$img_urlに代入
        //画像がなければ空文字にする

        $profile = Profile::where('user_id', Auth::id())->first();
        // 現在ログイン中のユーザーのプロフィールを一見探す
        if ($profile){
            $profile->update([
                'user_id' => Auth::id(),
                'img_url' => $img_url,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
            // プロフィールの情報を上書き更新
        }else{
            Profile::create([
                'user_id' => Auth::id(),
                'img_url' => $img_url,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
            // プロフィール情報がなければ新しく作成する
        }

        User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        // ログイン中のusersテーブルのnameカラムも変更する

        return redirect('/');
    }

    public function mypage(Request $request){
        $user = User::find(Auth::id());
        if ($request->page == 'buy'){ //購入履歴を表示
            $items = SoldItem::where('user_id', $user->id)->get()->map(function ($sold_item) {
                return $sold_item->item;
            });
            // sold_itemsテーブルからログイン中のユーザーが購入した商品（item）を取り出し、作り直す

        }else { //出品履歴を表示
            $items = Item::where('user_id', $user->id)->get();
            // ユーザが出品した商品一覧（item）をしゅと
        }
        return view('mypage', compact('user', 'items'));
    }
}


