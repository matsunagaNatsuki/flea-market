<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'item_id'];

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'item_id',
    ];
    // 自動連番で、idカラムを増やすのではなく、idカラムの主キーを自分で決める

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    // Likeはuser_idを使ってUserモデルに属している（userに紐づいている）

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    // Likeモデルは１つの商品に紐付いている

    public function liked($item_id)
    {
        $count = Like::where('item_id', $item_id)->where('user_id',Auth::id())->count();
        // その商品に自分が「いいね」している数をカウントしている
        return $count > 0;
        //いいね済み」なら true、「まだいいねしていない」なら false
    }

}
