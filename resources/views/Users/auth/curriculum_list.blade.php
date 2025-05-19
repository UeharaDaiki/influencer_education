@extends('Users.layouts.app')

@section('content')

<h1>これは授業一覧画面です。</h1>

<ul>
    <li><a href="{{ route('usershow.delivery', 1) }}">カリキュラムID: 1 の配信ページへ</a></li>
</ul>

@endsection