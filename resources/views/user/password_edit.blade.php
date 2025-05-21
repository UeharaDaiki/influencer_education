@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/password_edit.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href ="{{ route('user.show.profile') }}">←戻る</a>
                    <div class="pass-text">
                        <label>パスワード変更</label>
                    </div>
                    @if ($errors->any())
                        <div class="error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.password.edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="old-pass">
                            <label>旧パスワード</label>
                            <input class="old-pass-input" name="current_password" type="password">
                        </div>
                        <div class="new-pass">
                            <label>新パスワード</label>
                            <input class="new-pass-input" name="new_password" type="password">
                        </div>
                        <div class="new-pass-confirm">
                            <label>新パスワード確認</label>
                            <input class="new-pass-confirm-input" name="new_password_confirmation" type="password">
                        </div>
                        <input type="submit" value="登録" class="regist-button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
