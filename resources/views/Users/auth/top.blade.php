@extends('Users.layouts.app')

@section('content')
<div class="container">
    {{-- バナー画像表示 --}}
    <div class="banner-area">
        <div class="carousel">
            @if ($banners->isNotEmpty())
            @foreach ($banners as $index => $banner)
            <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー{{ $index + 1 }}" class="carousel-img">
            @endforeach
            @else
            <img src="{{ asset('images/sample_banner.jpg') }}" alt="サンプルバナー" class="carousel-img">
            @endif
        </div>
        <div class="carousel-indicator">
            @foreach ($banners as $index => $banner)
            <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>
    </div>


    <h2 class="news-title">お知らせ</h2>

    <div class="box2">
        @if($article_top->isEmpty())
        <p>現在お知らせはありません。</p>
        @else
        @foreach($article_top as $article)
        <div class="news-item">
            <a href="{{route('userarticle.show', ['id' => $article->id]) }}">
                <span class="news_date">{{ $article->posted_date->format('Y年m月d日') }}</span>
                <span class="news_contents">{{ $article->title }}</span>
            </a>
        </div>
        @endforeach
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            let current = 0;
            const images = $('.carousel-img');
            const dots = $('.dot');

            function showSlide(index) {
                images.removeClass('active').eq(index).addClass('active');
                dots.removeClass('active').eq(index).addClass('active');
            }

            dots.click(function() {
                current = $(this).index();
                showSlide(current);
            });

            showSlide(0); // 初期表示
        });
    </script>
    @endsection