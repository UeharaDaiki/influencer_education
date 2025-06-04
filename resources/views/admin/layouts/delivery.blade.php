@extends('admin.layouts.app')

@section('content')
  <div class="header container">
    <a href="{{ route('admin.show.curriculum.list') }}">←戻る</a>
    <div><h1>配信日時画面</h1></div>
  </div>
  <section>
    <div class="col-md-6 offset-md-3">
      @if (session('error'))
        <div class="alert alert-danger" role="alert">
          {{ session('error') }}
        </div>
      @endif
      <form method="POST" action="{{ route('admin.update.delivery',['id'=>$id]) }}">
        @csrf
        <div>
          <h2>{{ $title }}</h2>
        </div>
        @php
          // 直前に入力した値をそのまま残す、無ければDBデータ
          // pluckでdelivery_fromのカラムだけを抽出してる
          $from = old('delivery_from',$deliveryTime->pluck('delivery_from')->toArray());
          $to = old('delivery_to',$deliveryTime->pluck('delivery_to')->toArray());
        @endphp
        {{-- エラー文用 indexが無いと全inputにメッセが出る --}}
        @forelse ( $from as $index => $fromTime )
          <div class="row">
            {{-- mb-3で下にスペースを開ける --}}
            <div class="col-3 mb-3">
              <input type="datetime-local" class="form-control" name="delivery_from[]" value="{{ $fromTime }}">
              @error("delivery_from.$index")
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-1 text-center mb-3">
              〜
            </div>
            <div class="col-3 mb-3">
              <input type="datetime-local" class="form-control" name="delivery_to[]" value="{{ $to[$index] ?? '' }}">
              @error('delivery_to')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              @error("delivery_to.$index")
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-1 text-center mb-3">
              {{-- name属性はform送信に関与してる 今回はjsで非表示にするからいらない--}}
              <button type="button" class="btn btn-danger remove-row">ー</button>
            </div>
          </div>
        @empty
          {{-- 既存データがないときの画面表示 --}}
          <div class="row">
            <div class="col-3 mb-3">
              <input type="datetime-local" class="form-control" name="delivery_from[]">
              @error("delivery_from.*")
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-1 text-center mb-3">
              〜
            </div>
            <div class="col-3 mb-3">
              <input type="datetime-local" class="form-control" name="delivery_to[]">
              {{-- emptyは1行しか表示しないから$indexはいらない --}}
              @error("delivery_to.*")
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-1 text-center mb-3">
              <button type="button" class="btn btn-danger remove-row">ー</button>
            </div>
          </div>
        @endforelse
        <div class="row" id="add_time">
        </div>
        <input type="button" class="btn btn-primary" id="delivery_time" value="+" >
        <div class="col-md-6 offset-md-3"><button type="submit" class="btn btn-success" id="submit">登録</button></div>
      </form>
    </div>
  </section>
@endsection