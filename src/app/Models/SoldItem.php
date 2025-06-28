<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';//主キー(primary key)を'item_id'に設定

    public $incrementing = false;//ユーザーが設定する

    protected $fillable = [ //一括代入を許可
        'user_id',
        'item_id',
        'sending_postcode',
        'sending_address',
        'sending_building'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
