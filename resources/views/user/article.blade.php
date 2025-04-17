@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/article.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href ="{{ route('user.show.top') }}">←戻る</a>
                    <div class="posted-date">
                        <label>{{ $PostedDate }}</label>
                    </div>
                    <div class="title">
                        <label>{{ $article -> title }}</label>
                    </div>
                    <div class="article-contents">
                        <label>{{ $article -> article_contents }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
