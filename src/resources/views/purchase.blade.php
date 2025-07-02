@extends('layouts.default')

@section('title','購入手続き')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth/purchase.css')  }}">
@endsection

@section('content')

@include('components.header')
<div class="container">
    <form class="buy" id="stripe-form" action="/purchase/{{$item->id}}" method="post">
        <div class="buy__left">
            <div class="item">
                <div class="item__img">
                    <img src="{{ \Storage::url($item->img_url) }}" alt="">
                    <!-- データベースに保存された画像ファイルを表示する -->
                </div>
                <div class="item__info">
                    <h3 class="item__name">{{$item->name}}</h3> <!--商品名を表示-->
                    <p class="item__price">￥ {{number_format($item->price)}}</p> <!--商品の値段を3桁区切りにして表示-->
                </div>
            </div>
            <div class="purchases">
                <div class="purchase">
                    <div class="purchase__flex">
                        <h3 class="purchase__title">支払い方法</h3>
                    </div>
                    <select class="purchase__value" id="payment" name="payment_method">
                        <option value="konbini">コンビニ払い</option>
                        <option value="card">クレジットカード払い</option>
                    </select>
                </div>
                <div class="purchase">
                    <div class="purchase__flex">
                        <h3 class="purchase__title">配送先</h3>
                        <button type="button" id="destination__update">変更する</button>
                    </div>
                    <div class="purchase__value">
                        <label>〒 <input class="input_destination" name="destination_postcode" value="{{ $user->profile->postcode }}" readonly></label><br>
                        <!-- ログイン中のユーザーのプロフィールから郵便番号を取得して表示！ -->
                        <!-- readonlyでフォームの入力ができないようにする -->
                        <input class="input_destination" name="destination_address" value="{{ $user->profile->address }}" readonly><br>
                        @if (isset($user->profile->building))
                        <input class="input_destination" name="destination_building" value="{{ $user->profile->building }}" readonly>
                        @endif
                    </div>
                    <div class="setting__flex">
                        <button type="button" id="destination__setting">変更完了</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="buy__right">
            <div class="buy__info">
                <table>
                    <tr>
                        <th class="table__header">商品代金</th>
                        <td id="item__price" class="table__data" value="{{ number_format($item->price) }}">￥ {{ number_format($item->price) }}</td>
                    </tr>
                    <tr>
                        <th class="table__header">支払い方法</th>
                        <td id="pay_confirm" class="table__data">コンビニ払い</td>
                    </tr>
                </table>
            </div>
            @csrf
            @if ($item->sold()) <!--売り切れた場合-->
            <button class="btn disabled" disabled>売り切れました</button>
            @elseif ($item->mine())<!--自分が出品した商品の場合-->
            <button class="btn disabled" disabled>購入できません</button>
            @else
            <button id="purchase_btn" class="btn">購入する</button>
            @endif
        </div>
    </form>
</div>
    <!-- stripe(クレジットカード決済サービス)を使用するための準備コード -->
<script src="https://js.stripe.com/v3/"></script>
<!-- stripeの支払い画面に飛ぶ機能。新型バージョン -->
<script src="https://checkout.stripe.com/checkout.js"></script>
<!-- ページ内にStripeが用意した支払い方法が出てきて、直接支払いを行う。旧型バージョン -->
<script src="{{ asset('js/purchase.js') }}"></script>
<!-- ボタンを押したら支払い処理を開始する -->
@endsection
