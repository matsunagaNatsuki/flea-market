@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

<h1>flea market</h1>
@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">新規登録</h2>
</div>

<p>メールアドレスとパスワードを入力してください</p>

<div class="register-form__inner">
    <form class="register-form__form" action="/register" method="post">
        @csrf
        <div class="register-form__group">
            <label class="register-form__label" for="name">お名前
            </label>
            <input class="register-form__input" type="text" name="name" id="name">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="email">メールアドレス
            </label>
            <input class="register-form__input" type="email" name="email" id="email">
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="password">パスワード
            </label>
            <input class="register-form__input" type="password" name="password" id="password">
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="password_confirmation">確認用パスワード
            </label>
            <input class="register-form__input" type="password" name="password_confirmation" id="password_confirmation">
                <p class="register-form__error-message">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </p>
        </div>

            <input class="register-form__btn btn" type="submit" value="登録">

        <div class="register-header__link">
            <p class="register-form__text">すでにアカウントをお持ちの方は</p>
            <a href="/login">login</a>
        </div>
    </form>
</div>


