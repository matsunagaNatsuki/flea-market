@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/profile_edit.css') }}">
@endsection

@section('content')
<div class="profile-form">
    <h2 class="profile-form__heading content__heading">プロフィール設定</h2>
    <div class="profile-form__inner">
        <form class="profile-form" action="edit_profile" method="post">
            @csrf
            <div class="profile-form__group">
                <label class="profile-form__label" for="profile_image">画像を選択する</label>
                <input class="profile-form__input" type="file"
                name="image" id="image">
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label" for="name">ユーザー名</label>
                <input class="profile-form__input" type="text" name="name" id="name" value="{{ old('name') }}">
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="postal">郵便番号</label>
                <input class="profile-form__input" type="number" name="postal" id="postal" value="{{ old('postal') }}">
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="address">住所</label>
                <input class="profile-form__input" type="text" name="address" id="address" value="{{ old('address') }}">
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="build">建物名</label>
                <input class="profile-form__input" type="text" name="build" id="build" value="{{ old('build') }}">
            </div>

            <div class="btn">
                <a href="/" type="submit">更新する</a>
            </div>
        </form>
    </div>
</div>
@endsection

