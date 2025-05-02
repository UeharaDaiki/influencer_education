<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!-- アプリの言語設定をHTMLのlang属性に反映 -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>トップ画面</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net"> <!-- フォント読み込みのパフォーマンス向上 -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> <!-- Nunitoフォントの読み込み -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>

<body>

    <!-- ▼ ナビゲーションバーの開始 -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a style="margin-left: 100px;" href="{{route('showCurriculumList')}}" class="menu-btn">時間割</a>
            <a style="margin-left: 50px;" href="{{route('showProgress')}}" class="menu-btn">授業進捗</a>
            <a style="margin-left: 50px;" href="{{route('showProfileForm')}}" class="menu-btn">プロフィール設定</a>
            <!-- ▼ ログアウト実行用フォーム（非表示） -->
            <a href="{{ route('login') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                style="margin-left: 0px;" class="logout-link">ログアウト</a>

            <form id="logout-form" action="{{ route('logout')}}" method="post" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
    <!-- ▼ メインの内容をここに差し込む（各画面の @section('content') が入る） -->
    <main class="py-4">
        @yield('content')
    </main>

    </div>
</body>

</html>