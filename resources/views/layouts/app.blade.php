<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学習サイト</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- ヘッダー部分 -->
    <header>
        <div class="header-button">
            <button class="layout-button">時間割</button>
            <button class="layout-button">授業進捗</button>
            <button class="layout-button">プロフィール設定</button>
            <button class="logout-button">ログアウト</button>
        </div>
        
    </header>

    <!-- コンテンツ部分 -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
