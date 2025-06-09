@extends('admin.layouts.app')

@section('content')
  <div class="header container">
    <a href="{{ route('admin.show.curriculum.list') }}">←戻る</a>
    <div><h1>授業編集画面</h1></div>
  </div>
  <section>
    <div class="col-md-6 offset-md-3">
      @if (session('error'))
        <div class="alert alert-danger" role="alert">
          {{ session('error') }}
        </div>
      @endif
      <form method="POST" action={{ route('admin.curriculum.update',['id'=>$id]) }} enctype="multipart/form-data">
        @csrf
        @foreach ( $edit_curriculum as $edit_curriculum )
        <div>
          <img src="{{ asset($edit_curriculum->thumbnail ?? 'storage/images/default_img.png') }}" class="card-img-top w-25" alt="サムネイル">
          <label for="img">サムネイル</label>
          <input type="hidden" name="curriculum_img" id="img_old" value="{{ $edit_curriculum->thumbnail }}">
          <input type="file" name="curriculum_img" id="img">
        </div>
        <div class="mb-3 row">
          <label for="grade_id" class="col-sm-2 col-form-label">学年</label>
          <div class="col-sm-10">
            <select name="grade_id" id="grade_id">
              @foreach ($grades as $grade)
                <option value="{{ $grade->id }}" {{ $grade->id == $edit_curriculum->grade_id ? 'selected' : '' }}>{{ $grade->name }}</option>
              @endforeach
            </select>
            @error('grade_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="mb-3 row">
          <label for="title" class="col-sm-2 col-form-label">授業名</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="title" name="title" value="{{ $edit_curriculum->title }}">
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="mb-3 row">
          <label for="video_url" class="col-sm-2 col-form-label">動画URL</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $edit_curriculum->video_url }}">
            @error('video_url')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="mb-3 row">
          <label for="description" class="col-sm-2 col-form-label">授業概要</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="description" name="description" value="{{ $edit_curriculum->description }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="form-check">
          <input name="always_delivery_flg" type="hidden" value="0">
          <input class="form-check-input" type="checkbox" value="1" {{ $edit_curriculum->always_delivery_flg == 1 ? 'checked' : '' }} id="always_delivery_flg" name="always_delivery_flg">
          <label class="form-check-label" for="always_delivery_flg">
            常時公開
          </label>
        </div>
        <div class="col-md-6 offset-md-3"><button type="submit" class="btn btn-success">登録</div>
        @endforeach
      </form>
    </div>
  </section>
@endsection
