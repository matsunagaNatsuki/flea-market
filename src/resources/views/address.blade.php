@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/address.css') }}">
@endsection

@section('content')
<div class="address-form">
    <h2 class="address-form__heading content__heading">住所の変更</h2>
    <div class="address-form__inner">
        <form class="address-form__form" action="/address" method="POST">
            @csrf

            <div class="address-form__group">
                <label class="address-form__label" for="postal_code">郵便番号</label>
                <input class="address-form__input" type="postal_code" name="postal_code" id="postal_code">
            </div>

            <div class="address-form__group">
                <label class="address-form__label" for="address">住所</label>
                <input class="address-form__input" type="address" name="address" id="address">
            </div>

            <div class="address-form__group">
                <label class="address-form__label" for="building">建物名</label>
                <input class="address-form__input" type="building" name="building" id="building">
            </div>

            <input class="address-form__btn btn" type="button" value="更新する" onclick="location.href='{{ url('/') }}'">
        </form>
    </div>

</div>

