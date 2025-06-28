@extends('layouts.default')

<!-- タイトル -->
@section('title','トップページ')

<!-- css読み込み -->
@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth/index.css') }}">
@endsection

<!-- 本体 -->
@section('content')

@include('components.header')
<div class="border">
    <ul class="border__list">
        <li><a href="{{ route('items.list', ['tab'=>'recommend', 'search'=>$search ?? '']) }}">おすすめ</a></li>
        <!-- おすすめのタブを表示する -->

        @if(!auth()->guest()) <!--　ログインしている人だけが見れるタブ -->
        <li><a href="{{ route('items.list', ['tab'=>'mylist','search'=>$search ?? '']) }}">マイリスト</a></li>
        <!-- マイリストのタブを表示する -->
        @endif
    </ul>
</div>

<div class="container">
    <div class="items">
        @foreach ($items as $item)
        <!-- 一つ一つの商品を繰り返し処理で取り出して使用する-->
        <div class="item">
            <a href="/item/{{$item->id}}">
                <!-- クリックしたら商品詳細画面に飛ぶ -->
                @if ($item->sold())<!--もし、商品が売れきれなら-->
                <div class="item__img--container sold">
                    <img src="{{ \Storage::url($item->img_url) }}" class="item__img" alt="商品画像">
                </div>
                <!-- この商品が売れきれならtrueを返し、売れた時の商品の画像を表示 -->
                @else<!--売れていなければ通常の画像を表示-->
                <div class="item__img--container">
                    <img src="{{ \Storage::url($item->img_url) }}" class="item__img" alt="商品画像">
                </div>
                @endif
                <p class="item__name">{{$item->name}}</p>
                <!-- pタグで商品名を画面に表示 -->
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection

