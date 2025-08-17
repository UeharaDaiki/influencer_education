<aside class="sidebar">
    @foreach ($grades as $grade)
        @if(Str::contains($grade->name, '小学校'))
            <button type="button"  class="grade_btn elementary" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</button>
        @elseif(Str::contains($grade->name, '中学校'))
            <button type="button"  class="grade_btn junior" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</button>
        @elseif(Str::contains($grade->name, '高校'))
            <button type="button"  class="grade_btn high" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</button>
        @endif
    @endforeach
</aside>