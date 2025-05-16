<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>時間割</title>
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/timetable.css') }}">
    </head>
    <body>
        @include('user.layouts.app')

        <div class="main_header">
            <a href="{{ route('user.show.top') }}" class="back">←戻る</a>
            <div id="calendar">
                <button id="prevMonth">◀︎</button>
                <span id="activeMonth">{{ now()->format('Y年m月') }} スケジュール</span>
                <button id="nextMonth">▶︎</button>
            </div>

            @if(Str::contains($gradeName, '小学校'))
                <button id="selectedGrade" class="grade_name elementary" disabled>{{ $gradeName }}</button>
            @elseif(Str::contains($gradeName, '中学校'))
                <button id="selectedGrade" class="grade_name junior" disabled>{{ $gradeName }}</button>
            @elseif(Str::contains($gradeName, '高校'))
                <button id="selectedGrade" class="grade_name high" disabled>{{ $gradeName }}</button>
            @endif
        </div>

        @include('user.grade_sidebar')

        <main id="curriculum_list">
            @forelse($curriculums as $curriculum)
                @if($curriculum->always_delivery_flg == 1 || $curriculum->deliveryTimes->isNotEmpty()) <!-- 配信予定なしのカリキュラムを除外 -->
                <div class="curriculum">
                    <img src="{{ $curriculum->thumbnail }}" alt="サムネイル" class="thumbnail">
                    <a href="{{ route('user.show.delivery',  ['id' => 1]) }}" class="curriculum_title">{{ $curriculum->title }}</p>
                    <ul class="curriculum_times">
                        @if ($curriculum->always_delivery_flg == 1)
                            <li><a href="{{ route('user.show.delivery',  ['id' => 1]) }}">常時配信</a></li>
                        @else
                            @foreach($curriculum->deliveryTimes as $deliveryTime)
                                <li><a href="{{ route('user.show.delivery', ['id' => 1]) }}">{{ $deliveryTime->formatted_from }} ~ {{ $deliveryTime->formatted_to }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif
            @empty
                <p class="no_curriculum">現在、カリキュラムはありません。</p>
            @endforelse
        </main>

        <script>
                const userGradeId = parseInt("{{ $gradeId }}", 10);
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('js/user/userCurriculumList.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>