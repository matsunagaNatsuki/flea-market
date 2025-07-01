<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'comment'
    ];
    // 上記のカラムの値を変数に入れることができる

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    // このコメントは1人のユーザによってコメントされている

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    // このコメントは一つの商品に対してのコメントをしている
}
