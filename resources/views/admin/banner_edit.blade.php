<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>バナー管理</title>
    <link rel="stylesheet" href="{{ asset('css/adminHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
</head>
<body>
    @include('admin.layouts.app')
    
    <div class="container">
        <a href="{{ route('admin.show.top') }}">←戻る</a>

        <h1>バナー管理</h1>

        <form action="{{ route('admin.store.banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="image-fields">
                @foreach ($banners as $banner)
                    <div class="image-fields__form">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー画像" class="image-fields__preview">
                        <label class="custom-file-label">
                            ファイルを選択
                            <input accept="image/*" type="file" name="banners[]" class="image-fields__input">
                        </label>
                        <button type="button" class="image-fields__remove-button" data-banner-id="{{ $banner->id }}">ー</button>
                    </div>
                @endforeach
                <button type="button" class="image-fields__add-button">+</button>
            </div>

            <div>
                <button type="submit" class="form-button">登録</button>
            </div>
        </form>

    </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('js/admin/banner.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>