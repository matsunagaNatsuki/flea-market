<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;//通知機能を追加
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
// implements MustVerifyEmailによってユーザー登録後、確認用リンクが送ることができ、認証メールの再送ができる
{
    use HasApiTokens, HasFactory, Notifiable;
    // HasApiTokens=API認証に使用するトークンを管理する
    // HasFactory=テストデータを作成
    // Notifiable=ユーザーにメール通知を送信できるようにする


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 以下のカラムだけフォームから受け取ったデータをモデルに渡すことで、登録を許可する
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // $hiddenを設定することで、データを外に漏らさないようにする

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // $castsで設定することで、自動で日付や時間のデータとして取り扱う

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    // UserモデルはProfileモデルと一対一の関係
    // （このユーザーに紐付いたプロフィール情報は一件あります）

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    // 1人のユーザーが行ったたくさんのいいねがある

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}