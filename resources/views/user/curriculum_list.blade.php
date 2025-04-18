<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>時間割</title>
    </head>
    <body>
        <header>
            <div>
                <button>時間割</button>
                <button>授業進捗</button>
                <button>プロフィール設定</button>
                <a href="#">ログアウト</a>
            </div>
        </header>

        <div>
            <a href="#">戻る</a>
            <div>
                <button>◀︎</button>
                <span>2025年4月スケジュール</span>
                <button>▶︎</button>
            </div>
            <span>小学校1年生</span>
        </div>

        <div>
            <aside>
                @foreach ($grades as $grade)
                    <button>{{ $grade->name }}</button><br>
                @endforeach
            </aside>
            <main>
                <div>
                    <img src="#" alt="サムネイル">
                    <h2>授業タイトル</h2>
                    <ul>
                        <li>4月15日 14:00~15:00</li>
                        <li>4月15日 14:00~15:00</li>
                        <li>4月15日 14:00~15:00</li>
                    </ul>
                </div>
            </main>
        </div>
        
    </body>
</html>