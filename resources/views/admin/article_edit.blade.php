@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/articleEdit.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href ="{{ route('admin.show.article.list') }}">←戻る</a>
                    @isset($article)
                    <!-- 前ページで変更ボタンが押された場合 -->
                    <div class="article-detail">
                        お知らせ変更
                    </div>
                    @if ($errors->any())
                        <div>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li class="error">{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.article.edit',$article->id) }}">
                        @csrf
                        <div class="posted-date">
                            <label>投稿日時</label>
                            <input class="input-date" name="postedDate" type="date" value="{{ $article->posted_date }}">
                        </div>
                        <div class="title">
                            <label>タイトル</label>
                            <input class="input-title" name="title" type="text" value="{{ $article->title }}">
                        </div>
                        <div class="contents">
                            <label class="contents-label">本文</label>
                            <textarea class="input-contents" name="contents" type="textarea">{{ $article->article_contents }}</textarea>
                        </div>
                        <input class="regist-btn" type="submit" value="登録">
                    </form>
                    @else
                    <!-- 前ページで新規登録ボタンが押された場合 -->
                    <div class="article-detail">
                        お知らせ新規登録
                    </div>
                    @if ($errors->any())
                        <div>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li class="error">{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.article.create') }}">
                        @csrf
                        <div class="posted-date">
                            <label>投稿日時</label>
                            <input class="input-date" name="postedDate" type="date">
                        </div>
                        <div class="title">
                            <label>タイトル</label>
                            <input class="input-title" name="title" type="text">
                        </div>
                        <div class="contents">
                            <label class="contents-label">本文</label>
                            <textarea class="input-contents" name="contents" type="textarea"></textarea>
                        </div>
                        <input class="regist-btn" type="submit" value="登録">
                    </form>
                    @endisset

                </div>
            </div>
        </div>
    </div>
</div>
@endsection