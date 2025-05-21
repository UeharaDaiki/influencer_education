@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/curriculumProgress.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"></div>
                    <a href ="{{ route('user.show.top') }}">←戻る</a>
                <div>
                    <img class="image" src="{{ asset('storage/'.$user->profile_image) }}" alt="{{ asset($user->profile_image) }}">
                    <div class="profile">
                        {{ $user->name }}さんの授業進捗<br>現在の学年:
                        @if($user->grade_id <= GradeTitles::ELEMENTARY_MAX)
                        <button class="elementary">小学{{ $user->grade_id }}年生</button>
                        @elseif($user->grade_id >= GradeTitles::HIGH_SCHOOL_MIN)
                        <button class="high">高校{{ $user->grade_id- GradeTitles::ELEMENTARY_AND_JUNIORHIGH }}年生</button>
                        @else
                        <button class="junior-high">中学{{ $user->grade_id- GradeTitles::ELEMENTARY_MAX }}年生</button>
                        @endif
                    </div>
                </div>
                <div class="grid">
                @foreach ($gradeTitles as $gradeId => $gradeTitle)
                    <!-- 学年タイトルを表示 -->
                        <div>
                            <div class="elementary-curriculum">{{ $gradeTitle }}</div>

                            @foreach ($curriculums as $curriculum)
                                @if ($curriculum->grade_id == $gradeId)
                                    <div class="grid-item">
                                    @foreach($curriculumsProgress as $clearCurriculum)
                                        @if($clearCurriculum->curriculum_id == $curriculum->id)
                                            <!-- 授業IDが一致した場合の処理 -->
                                            <span class="complete">受講済</span>
                                        @endif
                                    @endforeach
                                        @if($user->grade_id >= $curriculum->grade_id)
                                            <!-- ユーザーの学年よりも下の学年の授業は画面遷移できるようにリンクを追加 -->
                                            <a href="{{ route('user.show.delivery', $curriculum->id) }}">{{ $curriculum->title }}</a>
                                        @else
                                            <!-- ユーザーの学年よりも上の学年の授業はタイトルの表示のみ -->
                                            <label>{{ $curriculum->title }}</label>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
