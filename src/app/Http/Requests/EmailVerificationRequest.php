<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Auth\StatefulGuard;
// ログイン、ログアウト、ユーザー取得などの認証処理の管理を行う機能をインポートしている
use Illuminate\Foundation\Http\FormRequest;
// エラーメッセージなどのバリデーションの機能


/*EmailVerificationRequestはLaravelがもらったFormRequestを継承している。
→つまり、EmailVerificationRequestはFormRequestの子クラス！*/
class EmailVerificationRequest extends FormRequest
{
    /**protectedとは同じクラスの中と継承した子クラスのみに定義できる　*/
    protected $unauthenticated_user;
    // まだ本登録していないけど、仮登録済みのユーザを一時的に保存しておく
    protected $guard;
    // ユーザーをログインさせるための認証ガード

    public function __construct(StatefulGuard $guard)
    {
        $this->unauthenticated_user = session()->get
        ('unauthenticated_user');
    }
    /**セッションに保存してあるunauthenticated_userという名前のデータを取り出し、$this->unauthenticated_userに入れる。
     * このデータはメール認証がまだ終わっていないユーザーの情報を一時的に保管しておくためのもの
    */

    /**
     * Determine if the user is authorized to make this request.
     * （このリクエストを実行するユーザーに権限があるかどうかを確認する
     *
     * @return bool
     */
    public function authorize()
    {
        if (! hash_equals(
            (string) $this->unauthenticated_user->getKey(),
            (string) $this->route('id')
        ))
        // もし、unauthenticated_userと仮ユーザーIDが一致しなかったら
        {
            return false;
        }
        // リクエストを許可しない

        if (! hash_equals(  //もし二つの文字列が同じでなければ
            sha1($this->unauthenticated_user->getEmailForVerification()),
            //仮ユーザーのメールアドレスをsha1という方法で暗号化して、文字列に変換する
            (string) $this->route('hash')
            // URLの中に入っているhash（ごちゃ混ぜになった値）の値を取り出して文字列に変換する
        )) {
            return false;
            // リクエストを許可しない
        }

        return true;
        // 二つの値が一致したらリクエストを許可する
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (! $this->unauthenticated_user->hasVerifiedEmail()) {
            // もし、この仮ユーザーのメールがまだ認証されていないなら
            $this->unauthenticated_user->markEmailAsVerified();
            // このユーザーのメールを認証済みとしてマークする
            // email_verified_at カラムに現在の日時を自動で入れる

            $this->guard->login($this->unauthenticated_user);
            // この仮ユーザーをログイン状態にする
        }
    }

    /**
     * Configure the validator instance.
     * （バリデータインスタンスを設定する）
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        return $validator;
        // 何もバリデータを追加していない
    }
}
