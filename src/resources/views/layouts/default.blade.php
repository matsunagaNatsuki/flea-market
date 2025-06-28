<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- ページの文字コードをUTF−８に設定 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 最新のレンダリングエンジンを使用することでタグの表示や機能が動作する -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- レスポンシブ対応の設定の記述（画面やズーム幅など） -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- csrf対策トークンを使用できるようにするセキュリティ対策の設定 -->
    <title>@yield('title')</title>
    <!-- ブラウザのタブに表示されるページタイトルを差し込む -->
    <script src="https://kit.fontawesome.com/42694f25bf.js" crossorigin="anonymous"></script>
    <!-- Javascriptを使用してアイコンなどを表示する -->
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <!-- 郵便番号を入力すると自動で住所が表示されるシステム -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- toastr.cssを読み込むことで、ポップアップ通知が見た目も機能も整った状態で表示される -->
    @yield('css')
    {{--子ビュー（registerとloginブレードファイル）の @section を使って、親ビュー（default.blade.php）の @yield に中身を差し込む--}}
</head>

<body>
    @yield('content')
    <!-- 子ビュー（registerとloginブレードファイル）から差し込まれるページ本体の中身 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQueryライブラリ（ JavaScriptをもっと簡単に・短く・わかりやすく書けるようにするためのライブラリ）の読み込み-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- ポップアップ通知を表示するためのライブラリ -->


    <!-- ページの中身を差し込みJavascriptで「成功しました！」という通知を出す -->
    <script>
    // toastrの初期設定
        toastr.options = {
            "closeButton": true,
            // 閉じるボタンを表示
            "progressBar":true,
            // 時間の進行バーを表示
            "positionClass": "toast-bottom-right",
            // 右下に表紙
        }

        // sessionで通知を出す
        @if(Session::has('flashSuccess'))
        toastr.success("{{ session('flashSuccess') }}");
        @endif
    </script>
</body>

</html>