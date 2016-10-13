@if (! $product->authors->isEmpty())
    <div>
        作者
        @foreach($product->authors as $author)
            <a class="btn btn-default" href="{{ route('authors.show', $author->id) }}">
                {{ $author->name }}
            </a>
        @endforeach
    </div>
@endif