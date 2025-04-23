@extends('layouts.app')

@section('content')

  <div class="header container">
    {{-- ←戻る --}}
    <div>
      <a href="login"><h4>←戻る</h4></a>
    </div>
    {{-- 授業一覧画面 --}}
    <div class="title">
      <h1>授業一覧</h1>
    </div>
  </div>

  <div class="container">
    <div>
      <aside>
        <div class="d-flex justify-content-start gap-2 mb-3">
          {{-- 新規登録 --}}
          <a href="#" class="btn btn-success mb-3">新規登録</a>
          {{-- 表示中がくねん --}}
          <button type="button" class="btn btn-primary" style="margin-left: 110px">{{ $grade_name }}</button>
        </div>
      </aside>

      <section class="d-flex">
        {{-- 各学年 --}}
        <div class="d-flex flex-column gap-2">
          @foreach($grades as $grade)
          <a href="{{ route('admin.show.curriculum.list', ['id' => $grade->id ]) }}" class="btn btn-primary" style="min-width: 160px;" data-id="{{ $grade->id }}">{{ $grade->name }}</a>
          @endforeach
        </div>
        {{-- 授業一覧 --}}
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @foreach($curriculums as $curriculum)
            <div class="col" style="padding-left: 50px">
              <div class="card">
                <img src="{{ asset($curriculum->thumbnail) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $curriculum->title}}</h5>
                  {{-- <p class="card-text">{{ $curriculum->description}}</p> --}}
                  @foreach($delivery_times as $delivery_time)
                    <p class="card-text">
                      @if ($curriculum->id === $delivery_time->curriculums_id && $curriculum->always_delivery_flg === 0)
                        {{ substr($delivery_time->delivery_from , 0 , 16)}} ～ {{ substr($delivery_time->delivery_to , 0 ,16)}}<br>
                      @endif
                    </p>
                  @endforeach 
                  <div>
                    {{-- 配信日時 --}}
                    {{-- 授業内容編集 --}}
                    <a href="#" class="btn btn-success btn-sm">授業内容編集</a>
                    {{-- 配信日時編集 --}}
                    <a href="#" class="btn btn-success btn-sm">配信日時編集</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach      
        </div>
      </section>
    </div>
  </div>
@endsection
