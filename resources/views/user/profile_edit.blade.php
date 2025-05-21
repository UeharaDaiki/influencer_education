@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile_edit.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href ="{{ route('user.show.top') }}">←戻る</a>
                    @if ($errors->any())
                        <div class="error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                    @endif
                    <form method="POST" action="{{ route('user.profile.edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-text">
                            プロフィール設定
                        </div>
                        <div class="image">
                            <img class="profile-image" src="{{ asset($user->profile_image) }}" />
                            <div class="image-text">
                                <label>プロフィール画像</label><br>
                                <input name="image" type="file">
                            </div>
                        </div>
                        <div class="name">
                            <label>ユーザーネーム</label>
                            <input name="name" type="text" class="name-input" value="{{ $user->name }}">
                        </div>
                        <div class="kana">
                            <label>カナ</label>
                            <input name="kana" type="text" class="kana-input" value="{{ $user->name_kana }}">
                        </div>
                        <div class="email">
                            <label>メールアドレス</label>
                            <input name="email" type="text" class="email-input" value="{{ $user->email }}">
                        </div>
                        <div class="password">
                            <label>パスワード</label>
                            <a class="password-input" href ="{{ route('user.show.password.edit') }}">パスワードを変更する</a>
                        </div>
                        <input type="submit" value="登録" class="regist-button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
