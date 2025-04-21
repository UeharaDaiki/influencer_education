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
                <span>
                    <?php
                        $date = date('Y年m月');                      
                        echo $date;
                    ?>
                    スケジュール
                </span>
                <button>▶︎</button>
            </div>
            <span>{{ $gradeName }}</span>
        </div>

        <div>
            <aside>
                @foreach ($grades as $grade)
                    <button>{{ $grade->name }}</button><br>
                @endforeach
            </aside>
            <main>
                @foreach ($curriculums as $curriculum)
                    <div>
                        <img src="{{ $curriculum->thumbnail }}" alt="サムネイル">
                        <h2>{{ $curriculum->title }}</h2>
                        <ul>
                            @if ($curriculum->always_delivery_flg == 1)
                                <li><a href="#">常時配信</a></li>
                            @else
                                <li><a href="#">{{ $delivery_from }} ~ {{ $delivery_to }}</a></li>
                            @endif
                        </ul>
                    </div>
                @endforeach
            </main>
        </div>
        
    </body>
</html>