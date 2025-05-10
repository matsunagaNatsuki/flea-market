@extends('layouts.app')

@section('css')
<link rel="stylesheet" href=" asset('css/auth/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-form__group">
    <h2>{{ $sell->name }}</h2>
    <p>￥{{ $sell->price }}</p>
    <img src="{{ $sell->image }}" alt="{{ $sell->name }}">
</div>