@extends('layouts.default')

@section('title','商品詳細ページ')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
@endsection

@section('content')

@include('components.header')
<div class="container">
    <div class="item">
        @if ($item->sold())
        <div class="item__img sold">
            <img src="{{ \Storage::url($item->img_url) }}" alt="商品画像">
        </div>
        @else
        <div class="item__img">
            <img src="{{ \Storage::url($item->img_url) }}" alt="商品画像">
        </div>
        @endif

        <div class="item__info" id="scroll__item__info">
            <h2 class="item__name">{{$item->name}}</h2>
            <p class="item__pice">¥　{{number_format($item->price)}}</p>
            <!-- 数字を「3桁ごとにカンマ」でみやすく日本円として表示する -->


            <div class="item__form">
                <!-- この商品をいいねするorいいねを取り消す -->
                <form action="{{ $item->liked() ? '/item/unlike/'.$item->id : '/item/like/'.$item->id }}" method="post" class="item__like" id="like__form">
                    @csrf
                    <!-- iタグを使用してFont Awesomeのハートアイコンを表示し、「いいね」済みなら❤️、まだいいねしてないなら♡ -->
                    <button><i class="fa-2xl fa-heart {{ $item->liked() ? 'fa-sharp fa-solid' : 'fa-regular' }}"></i></button>
                    <!-- いいねの数をカウントする -->
                    <p class="like__count">{{$item->likeCount()}}</p>
                </form>

                <div class="item__comment">
                    <a href="#comment"><!--　ページ内のid="comment"へジャンプする -->
                        <i class="fa-regular fa-comment fa-2xl"></i><!--　コメントマークを表示-->
                    </a>
                    <p class="comment__count">{{$item->getComments()->count()}}</p><!--コメント数を表示-->
                </div>
            </div>

            @if ($item->sold())<!--もし売れきれなら-->
            <a href="#" class="btn item__purchase disabled" disable>売り切れました</a>
            @elseif($item->mine())<!--商品は売れてないけど出品者が自分の時-->
            <a href="#" class="btn item__purchase disabled" disabled>購入できません</a>
            @else<!--まだ売れておらず、出品者が他人の場合-->
            <a href="/purchase/{{$item->id}}" class="btn item__purchase">購入手続きへ</a>
            @endif

            <h3 class="item__section">商品説明</h3>
            <p class="item__description">{{$item->description}}</p>
            <h3 class="item__section">商品の情報</h3>
            <table class="item__table">
                <tr>
                    <th>ブランド</th>
                    <td>{{ ($item->brand !== null && $item->brand !== '') ? $item->brand : '未入力' }}</td>
                    <!-- brandプロパティがnull（未設定）もしくは空文字じゃないか確認し、値が入っていれば表示！空文字、nullなら「未設定」と表示する-->
                </tr>
                <tr>
                    <th>カテゴリー</th>
                    <td>
                        <ul class="item__table-category">
                            @foreach ($item->categories() as $category)<!--$itemに紐付いたカテゴリ一覧をループして一つずつ表示-->
                            <li class="category__btn">{{$category->category}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>商品の状態</th>
                    <td>{{$item->condition->condition}}</td><!--商品の状態を表示-->
                </tr>
            </table>
            <div id="comment" class="comment_section">
                <!-- コメント数をカウントして表示する -->
                <h3 id="count__tittle">コメント({{$item->getComments()->count()}})</h3>
                <div class="comments" id="comments__list">
                    <!-- 全てのコメント一覧を表示 -->
                    @foreach ($item->getComments() as $comment)
                    <div class="comment">
                        <div class="comment__user"><!--コメントの投稿者の情報を表示-->
                            <div class="user__img">
                                <img src="{{ \Storage::url($comment->user->profile->img_url) }}" alt="">
                                <!-- コメント投稿者のプロフィール情報を表示 -->
                            </div>
                            <p class="user__name">
                                {{$comment->user->name}}</p>
                            <!-- コメント投稿者の名前を表示 -->
                        </div>
                        <p class="comment__content">{{$comment->comment}}</p>
                        <!-- ユーザーが投稿したコメントの本文-->
                    </div>
                    @endforeach
                </div>
                <form action="/item/comment/{{$item->id}}" method="post" class="comment__form" id="comment__form">
                    <!-- コメントを新しく投稿するためのフォーム -->
                    @csrf
                    <p class="comment__form-title">商品へのコメント</p>
                    <textarea name="comment" id="comment__textarea" cols="30" rows="10" class="comment__form-textarea"></textarea>
                    <div class="form__error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                    <button class="btn comment__form-btn">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection