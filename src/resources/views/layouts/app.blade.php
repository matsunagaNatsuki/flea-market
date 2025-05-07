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

    <div class="nav-links">
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit" class="logout">ログアウト</button>
        </form>

        <a href="{{ url('/mypage') }}" class="mypage">マイページ</a>
    </div>
</div>

    <main>
        @yield('content')
    </main>
</body>
</html>