@extends('layouts.app')

@section('content')
  <div class="header container">
    <a href="{{ route('admin.show.curriculum.list') }}">←戻る</a>
    <div><h1>配信日時画面</h1></div>
  </div>
  <section>
    <div class="col-md-6 offset-md-3">
      <form method="POST" action={{ route('admin.update.delivery',['id'=>$id]) }}>
        @csrf
        <div>
          <h2>{{ $title }}</h2>
        </div>
        @foreach ( $deliveryTime as $deliveryTimes )
          <div class="row">
            <div class="col-3">
              <input type="datetime-local" class="form-control" name="delivery_from[]" value="{{ $deliveryTimes -> delivery_from }}">
            </div>
            〜
            <div class="col-3">
              <input type="datetime-local" class="form-control" name="delivery_to[]" value="{{ $deliveryTimes -> delivery_to }}">
            </div>
          </div>
          @endforeach 
        <div class="col-md-6 offset-md-3"><button type="submit" class="btn btn-success">登録</button></div>
      </form>
    </div>
  </section>
@endsection