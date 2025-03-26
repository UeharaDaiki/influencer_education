<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学習サイト</title>
    @yield('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- ヘッダー部分 -->
    <header>
        <div class="header-button">
            <a class="layout-button" href="{{ route('user.show.curriculum') }}">時間割</a>
            <a class="layout-button" href="{{ route('user.show.progress') }}">授業進捗</a>
            <a class="layout-button" href="{{ route('user.show.profile') }}">プロフィール設定</a>
            <a class="logout-button" href="{{ route('user.show.login') }}">ログアウト</a>
        </div>
        
    </header>

    <!-- コンテンツ部分 -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
