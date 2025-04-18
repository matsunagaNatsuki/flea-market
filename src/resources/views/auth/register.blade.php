<form action="/register" method="POST">
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" id="name" required>

    <label for="email">メールアドレス</label>
    <input type="email" name="email" id="email" required>

    <label for="password">パスワード</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">パスワード確認</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">登録</button>
</form>


