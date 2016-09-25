@if (!empty($movie->first()))
<h3>電影額外選項</h3>
<p>{{ $movie->origin_name }}</p>
<p>{{ $movie->runtime }}</p>
<p>{{ $movie->trailer }}</p>
    @endif
