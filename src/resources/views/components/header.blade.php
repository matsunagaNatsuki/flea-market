<header class="header">
    <div class="header__logo">
        <a href="/"><img src="{{ asset('img/logo.svg') }}" alt="ロゴ"></a>
        <!-- ロゴの画像をクリックするとトップ画面に移動する。 -->
    </div>
    @if( !in_array(Route::currentRouteName(), ['register', 'login','verification.notice']) )
    <!-- もし、「会員登録」「ログイン」「メールアドレス確認」でなければ以下のヘッダーを表示する！ -->
    <form class="header_search" action="/item" method="get">
        @csrf
        <input id="inputElement" class="header_search--input" type="text" name="search" placeholder="なにをお探しですか？">
        <button id="buttonElement" class="header_search--button">
            <img src="{{ asset('img/search_icon.jpeg') }}" alt="検索アイコン" style="height:100%;">
        </button>
    </form>
    <nav class="header__nav">
        <ul>
            @if(Auth::check())<!--ユーザーがログイン済みか確認したら以下のヘッダーを表示する-->
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button class="header__logout">ログアウト</button>
                </form>
            </li>
            <li><a href="/mypage">マイページ</a></li>
            @else   <!--もし、ユーザがログインしていないなら以下のボタンを表示する-->
            <li><a href="/login">ログイン</a></li>
            <li><a href="register">会員登録</a></li>
            @endif
            <a href="/sell">
                <li class="header__btn">出品</li>
            </a>
        </ul>
    </nav>
    @endif
</header>