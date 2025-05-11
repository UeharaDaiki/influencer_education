@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/article.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href ="{{ route('admin.show.top') }}">←戻る</a>
                    <div class="article-list">
                        お知らせ一覧
                    </div>
                    <div>
                        <a class="regist-button" href ="{{ route('admin.show.article.create') }}">新規登録</a>
                    </div>
                    <span class="date">投稿日時</span>
                    <span class="title">タイトル</span>
                    <div class="article-list-container">
                        @foreach ($articles as $article)
                        <div class="article-item">
                            <span class="date-list">
                                {{ $article->posted_date }}
                            </span>
                            <span class="title-list">
                                {{ $article->title }}
                            </span>
                            <div class="button-group">
                                    <a class="detail-btn" href ="{{ route('admin.show.article.edit',$article->id) }}" type="submit">変更する</a>
                                <form method="POST">
                                    @csrf
                                    <input type="submit" class="delete-btn" name="delete" data-id="{{ $article->id }}" value="削除">
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/articleDelete.js') }}"></script>
@endpush