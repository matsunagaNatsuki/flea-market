<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>

<div class="top-bar">
    <div class="logo">
        <img src="{{ asset('storage/images/logo.svg') }}?v={{ time() }}" alt="logo" class="logo-img">
    </div>

    <div class="search-container">
        <form method="GET" action="{{ url('/') }}" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="商品名で検索" value="{{ request()->input('search')}}">
            <button type="submit" class="search-button">🔍</button>
        </form>
    </div>

    <div class="nav-links">
        <form method="POST" action="{{ url('/logout') }}">
            <button type="submit" class="logout">ログアウト</button>
        </form>
            @csrf

        <a href="{{ url('/mypage') }}" class="mypage">マイページ</a>
        <a href="{{ url('/sell') }}" class="sell">出品</a>
    </div>
</div>

    <main>
        @yield('content')
    </main>
</body>
</html>