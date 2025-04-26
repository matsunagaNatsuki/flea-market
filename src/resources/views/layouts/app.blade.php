<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Flea market</title>
    @yield('css')
</head>

<body>
    <div class="logo">
    <img src="storage/app/public/images/logo.svg" class="logo-img">
    </div>

    <main>
        @yield('content')
    </main>

</body>
</html>