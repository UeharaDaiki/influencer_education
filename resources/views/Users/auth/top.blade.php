@extends('Users.layouts.app')

@section('content')
<div class="container">
    {{-- バナー画像表示 --}}
    <div class="banner-area">
        @if ($banner && $banner->image_path)
        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="バナー画像" class="banner-img">
        @else
        <img src="{{ asset('images/sample_banner.jpg') }}" alt="サンプルバナー" class="banner-img">
        @endif
    </div>

    {{-- カルーセル（ドットだけ） --}}
    <div class="carousel-indicator">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>

<h2 class="news-title">お知らせ</h2>

<div class="box2">
    @if($article_top->isEmpty())
    <p>現在お知らせはありません。</p>
    @else
    @foreach($article_top as $article)
    <div class="news-item">
        <a href="{{route('users.auth.article', ['id' => $article->id]) }}">
            <span class="news_date">{{ $article->posted_date->format('Y年m月d日') }}</span>
            <span class="news_contents">{{ $article->title }}</span>
        </a>
    </div>
    @endforeach
    @endif
</div>


@endsection