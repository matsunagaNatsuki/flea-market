<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [ //これらのカラムをテーブルに保存する
        'name',
        'price',
        'brand',
        'description',
        'img_url',
        'user_id',
        'condition_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //この商品（Item）は、あるユーザー（User）に属している　
    // belongsTo=１つの親に属している

    public function condition()
    {
        return $this->belongsTo('App\Models\Condition');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    // この商品に対して複数の人がいいねできる
    // hasMany=複数の子を持っている

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function categoryItem()
    {
        return $this->hasMany('App\Models\CategoryItem');
    }
    // 商品が複数のカテゴリーに属していて中間テーブルで管理している

    public function categories()
    {
        $categories = $this->categoryItem->map(function ($item) {
            return $item->category;
        });
        return $categories;
    }
    // category_Items（中間テーブル）を通して商品が属しているカテゴリ一覧をデータベースから取り出して表示する。

    public function liked()
    {
        return Like::where(['item_id' => $this->id, 'user_id' => Auth::id()])->exists();
    }
    // ログイン中のユーザーがこの商品（item_id)に「いいね」しているかどうかを確認し、商品に「いいね」していたらtrue、してなかったらfalseを返す。

    public function likeCount()
    {
        return Like::where('item_id', $this->id)->count();
    }
    // この商品(item_id)に対する「いいね」が何件あるか数えて返す

    public function getComments(){
        $comments = Comment::where('item_id', $this->id)->get();
        return $comments;
    }
    // commentテーブルの中からこの商品（item_id)に対するコメントを取ってくる


    public function sold(){
        return SoldItem::where('item_id',$this->id)->exists();
    }
    // sold_itemテーブルの中にこの商品（$this->id)のレコードがあるか調べる
    // 売れていたらtrue、売れていなければfalse

    public function mine() {
        return $this->user_id == Auth::id();
    }
    // 今ログインしている自分のユーザーIDとこの商品（user_id）が同じならtrueを返す

    public static function scopeItem($query,$item_name){
        return $query->where('name','like','%'.$item_name.'%');
    }
    // 商品名を部分一致検索をする
}