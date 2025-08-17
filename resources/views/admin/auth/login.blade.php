<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/adminLogin.css') }}">
    <title>管理ユーザーログイン</title>
</head>
<body>
    <div><a href="{{ route('admin.show.register') }}">新規会員登録はこちら</a></div>
    <h1>管理画面ログイン</h1>
    <div class="login-form">
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-group__label" for="email">メールアドレス</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <div class="form-group__error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="form-group__label" for="password">パスワード</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input"  type="password" name="password">
                    @if ($errors->has('password'))
                        <div class="form-group__error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>

            <button class="login-form__btn" type="submit">ログイン</button>
        </form>
    </div>
</body>
</html>