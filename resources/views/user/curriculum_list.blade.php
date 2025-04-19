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
                @foreach ($curriculums as $curriculum)
                    @foreach ($delivery_times as $delivery_time)
                        @if ($curriculum->id == $delivery_time->curriculums_id)
                            <div>
                                <img src="{{ $curriculum->thumbnail }}" alt="サムネイル">
                                <h2>{{ $curriculum->title }}</h2>
                                <ul>
                                    @if ($curriculum->always_delivery_flg== 1)
                                        <li><a href="#">常時配信</a></li>
                                    @else
                                            <li><a href="#">{{ $delivery_time->formatted_from }} ~ {{ $delivery_time->formatted_to }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        @else
                            @continue
                        @endif
                    @endforeach
                @endforeach
            </main>
        </div>
        
    </body>
</html>