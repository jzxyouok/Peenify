@if (!is_null($product->movie))
    <h3>電影額外選項</h3>
    <p>{{ $product->movie->origin_name }}</p>
    <p>{{ $product->movie->runtime }}</p>
    <p>{{ $product->movie->trailer }}</p>

    <h2>導演</h2>
    @foreach($product->authors as $author)
        <div class="form-group">
            <a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a>
        </div>
    @endforeach

    <h3>演員</h3>
    @foreach($product->actors as $actor)
        <div class="form-group">
            <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
        </div>
    @endforeach
@endif