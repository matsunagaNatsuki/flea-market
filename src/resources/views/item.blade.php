@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/item.css') }}">
@endsection

@section('content')
<div class="sell-form__group">
<h1>{{ $sell->name }}</h1>
<p><label for="brand">ブランド名</label>
</p>{{ $sell->brand }}
<p>価格: {{ $sell->price }}円</p>
<a href="{{ url('/purchase/' . $sell->id) }}" class="purchase-button">購入手続き</a>
<p>説明: {{ $sell->description }}</p>
</div>

<div class="image-upload">
<img src="{{ $sell->image }}" alt="{{ $sell->name }}">
</div>


