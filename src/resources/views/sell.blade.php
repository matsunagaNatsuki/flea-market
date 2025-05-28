@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/sell.css') }}">
@endsection



@section('content')
<div class="sell-form">
    <h1 class="sell-form__heading content__heading">商品の出品</h1>
    <div class="sell-form__inner">
        <form class="sell-form__form" action="/sell" method="post" enctype="multipart/form-data">
            @csrf

            <div class="sell-form__image">
                <label class="sell-form__label" for="image">商品画像を選択する</label>
                <input class="sell-form__input" type="file" name="image" id="image">
            </div>

            <div class="sell-detail__form">
                <h2 class="sell-detail__heading content_heading">商品の詳細</h2>

                <div class="sell-detail__form group">
                    <label class="sell-detail__label" for="category">カテゴリー</label>
                    <input class="sell-detail__input" type="text" id="category" name="name" autocomplete="off">
                </div>

                <label for="condition_id">商品の状態</label>
                <select name="condition_id" id="condition_id" required>
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : ''}}>
                            {{ $condition->condition_name }}</option>
                            @endforeach
                </select>

                <h2 class="sell-date__heading content_heading">商品名と説明</h2>

                <div class="sell-date__form group">
                    <label class="sell-date__label" for="name">商品名</label>
                    <input class="sell-date__input" type="text" id="name" name="name">
                </div>

                <div class="sell-date__form group">
                    <label class="sell-date__label" for="brand">ブランド名</label>
                    <input class="sell-date__input" type="text" id="brand" name="name">
                </div>

                <div class="sell-date__form group">
                    <label class="sell-date__label" for="description">商品の説明</label>
                    <input class="sell-date__input" type="text" id="description" name="description">
                </div>

                <div class="sell-date__form group">
                    <label class="sell-date__label" for="price">販売価格</label>
                    <input class="sell-date__input" type="text" id="price" name="price">
                </div>

                <div class="btn">
                    <a href="/" type="submit">出品する</a>
                </div>



            </div>

        </form>
    </div>
</div>