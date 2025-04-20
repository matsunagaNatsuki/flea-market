@extends('layouts.app')

@section('content')
<div class="profile-edit">
    <h2>プロフィール編集</h2>
    <form action="/mypage/profile" method="post">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>
        <button type="submit">保存</button>
    </form>
</div>
@endsection
