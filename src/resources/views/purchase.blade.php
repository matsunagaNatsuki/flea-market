@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/purchase.css') }}">
@endsection

@section('content')

<div class="purchase-form__group">
    <h1>{{ $sell->name }}</h1>
    <p class="price">￥{{ $sell->price }}</p>
</div>

<div class="image-upload">
<img src="{{ $sell->image }}" alt="{{ $sell->name }}" >
</div>

<form action="/purchase/{item_id}" method="POST">
    @csrf
    @php
        $selectedPaymentMethod = session('payment_method', '');
    @endphp

    <label for="payment_method">支払い方法</label>
    <select name="payment_method" id="payment_method" onchange="this.form.submit()">
        <option value="" {{ $selectedPaymentMethod == '' ? 'selected' : ''}}>選択してください</option>
        <option value="convenience_store" {{ session('payment_method') == 'convenience_store' ? 'selected' : '' }}>コンビニ払い</option>
        <option value="credit_card" {{ session('payment_method') == 'credit_card' ? 'selected' : ''}}>カード払い</option>
    </select>

    <div class="subtotal">
        <h3>小計</h3>
        <p>商品代金: ￥{{ $sell->price }}</p>
        <p>支払い方法:
            {{ session('payment_method') == 'convenience_store' ? 'コンビニ払い' : 'カード払い' }}
        </p>
    </div>

    <div class="btn">
        <button type="submit">購入する</button>
    </div>

    <div class="address-update">
        <label for="postal_code">配送先</label>
        <p>郵便番号： <span id="postal_code">{{ $user->profile->postal_code ?? '未登録' }}</span></p>
        <p>住所: <span id="address">{{ $user->profile->address ?? '未登録' }}</span></p>
        <p>建物名: <span id="building">{{ $user->profile->building ?? '未登録' }}</span></p>
    </div>
    <a href="/purchase/address/{{ $sell->id }}">変更する</a>
</form>



