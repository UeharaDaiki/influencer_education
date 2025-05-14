<header id="header">
    <div class="header_content">
        <button class="btn" onclick="location.href='{{ route('user.show.curriculum') }}'">時間割</button>
        <button class="btn" onclick="location.href='{{ route('user.show.progress') }}'">授業進捗</button>
        <button class="btn" onclick="location.href='{{ route('user.show.profile') }}'">プロフィール設定</button>
        <a href="{{ route('user.show.login') }}" class="logout">ログアウト</a>
    </div>
</header>