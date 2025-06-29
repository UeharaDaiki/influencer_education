<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/adminRegister.css') }}">
    <title>管理ユーザー新規登録</title>
</head>
<body>
    <a href="{{ route('admin.show.login') }}">ログインはこちら</a>
    <h1>新規管理ユーザー登録</h1>
    <div class="register-form">
        <form action="{{ route('admin.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-group__label" for="name">ユーザーネーム</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input" type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="form-group__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-group__label" for="name_kana">カナ</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input" type="text" name="name_kana" value="{{ old('name_kana') }}">
                    @error('name_kana')
                        <div class="form-group__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-group__label" for="email">メールアドレス</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input"  name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="form-group__error">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-group__label" for="password">パスワード</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input" type="text" name="password">
                    @error('password')
                        @if ($message !== '上記パスワードと一致しません')
                            <div class="form-group__error">{{ $message }}</div>
                        @endif
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-group__label" for="password_confirmation">パスワード確認</label>
                <div class="form-group__input-wrapper">
                    <input class="form-group__input" type="text" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="form-group__error">{{ $message }}</div>
                        @enderror

                        @error('password')
                            @if ($message === '上記パスワードと一致しません')
                                <div class="form-group__error">{{ $message }}</div>
                            @endif
                        @enderror
                </div>
            </div>

            <button class="register-form__btn" type="submit">登録</button>
        </form>    
    
    </div>

</body>
</html>