<aside class="grade_bar">
    @foreach ($grades as $grade)
        <button>{{ $grade->name }}</button><br>
    @endforeach
</aside>