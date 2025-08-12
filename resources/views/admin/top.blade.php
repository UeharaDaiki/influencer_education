<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者トップ画面</title>
        <link rel="stylesheet" href="{{ asset('css/adminHeader.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminTop.css') }}">
</head>
<body>
    @include('admin.layouts.app')

    <div class="main_content">
        <p>ユーザーネーム：<span>{{ $name }}</span></p>
        <p>メールアドレス：<span>{{ $email }}</span></p>
    </div>
</body>
</html>