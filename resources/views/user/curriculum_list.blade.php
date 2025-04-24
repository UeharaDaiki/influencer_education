<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>時間割</title>
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    </head>
    <body>
        @include('user.layouts.app')

        <div class="main_header">
            <a href="#" class="back">戻る</a>
            <div id="calendar">
                <button class="prev_btn">◀︎</button>
                <span>
                    <?php
                        $date = date('Y年m月');                      
                        echo $date;
                    ?>
                    スケジュール
                </span>
                <button class="next_btn">▶︎</button>
            </div>
            <span class="grade_name">{{ $gradeName }}</span>
        </div>

        <div>
            @include('user.grade_sidebar')
            <main>
                @foreach ($curriculums as $curriculum)
                    <div class="curriculum">
                        <img src="{{ $curriculum->thumbnail }}" alt="サムネイル" class="thumbnail">
                        <h2 class="curriculum_title">{{ $curriculum->title }}</h2>
                        <ul class="curriculum_times">
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