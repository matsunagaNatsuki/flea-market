@extends('layouts.app')

@section('css')
<link rel="stylesheet" href=" asset('css/auth/purchase.css') }}">
@endsection

@section('content')

<div class="purchase-form__group">
    <h2>{{ $sell->name }}</h2>
    <p>￥{{ $sell->price }}</p>
</div>

<div class="image-upload">
<img src="{{ $sell->image }}" alt="{{ $sell->name }}">
</div>

<form action="/purchase/{item_id}" method="POST">
    @csrf

    <h3>支払い方法</h3>

    <select name="payment_method" onchange="this.form.submit()">
        <option value="convenience_store" {{ session('payment_method') == 'convenience_store' ? 'selected' : '' }}>コンビニ払い</option>
        <option value="credit_card" {{ session('payment_method') == 'credit_card' ? 'selected' : '' }}>カード払い</option>
    </select>
</form>

<div class="subtotal">
    <h3>小計</h3>
    <p>商品代金: ￥{{ $sell->price }}</p>
    <p>支払い方法:
        {{ session('payment_method') == 'convenience_store' ? 'コンビニ払い' : 'カード払い' }}
    </p>
</div>
    <a href='/'>購入する</a>

    <p>配送先</p>
    <a href="/purchase/address/{{ $sell->id }}">変更する</a>



