@if (! $product->authors->isEmpty())
    @foreach($product->authors as $author)
        <div>
            <a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a>
        </div>
    @endforeach
@endif