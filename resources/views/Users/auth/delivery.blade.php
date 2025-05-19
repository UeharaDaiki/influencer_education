@extends('Users.layouts.app')

@section('content')

<button onclick="history.back()" class="return-btn">←戻る</button>

<div class="curriculum-detail">
    <div class="video-container">
        {{-- 動画 or 画像の出し分け --}}
        @if ($isDelivered)
        <video controls width="480" style="margin-left: 60px;">
            <source src="{{ asset('storage/' . $curriculum->video_url) }}" type="video/mp4">
            このブラウザでは動画が再生できません。
        </video>
        @else
        <img src="{{ asset('images/not_available.jpg') }}" alt="配信期間外" width="450" style="margin-left: 70px;">
        @endif

        {{-- 受講ボタン --}}
        <button id="curriculum-btn" data-id="{{ $curriculum->id }}"
            data-url="{{ route('usercurriculum.complete', ['id' => $curriculum->id]) }}"
            {{ (!$isDelivered || $isCompleted) ? 'disabled' : '' }}>
            {{ $isCompleted ? '受講しました' : ($isDelivered ? '受講する' : '配信期間外') }}
        </button>

        {{-- CSRFトークン --}}
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
    </div>

    <div class="curriculum-content">
        <div class="grade">{{ $curriculum->grade->name }}</div>
        <div class="curriculum-title" style="margin-top: 5px;">{{ $curriculum->title }}</div>
        <div class="curriculum-description" style="margin-top: 10px;">{{ $curriculum->description }}</div>
    </div>
</div>

<script>
    document.getElementById('curriculum-btn')?.addEventListener('click', function() {
        const button = this;
        const curriculumId = button.dataset.id;
        const url = button.dataset.url; // ← ここで route() の出力を使う
        const csrfToken = document.getElementById('csrf-token').value;

        if (!curriculumId) return;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (response.ok) {
                    button.textContent = '受講しました。';
                    button.disabled = true;
                } else {
                    alert('受講処理に失敗しました。');
                }
            })
            .catch(error => {
                console.error(error);
                alert('通信エラーが発生しました。');
            });
    });
</script>

@endsection