@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/profile.css') }}">
@endsection

<div class="btn">
<a href="mypage/profile">プロフィールを編集</a>
</div>

<div class="silver-line"></div>

<div class="profile-container">
    <div class="profile-image">
        <img src="{{ asset($profile->image ? 'storage/' . $profile->image : 'images/—Pngtree—cat default avatar_5416936.png') }}" alt="{{ $profile->name }}">
    </div>
    <h2 class="profile-name">{{ $profile->name }}</h2>
</div>