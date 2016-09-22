<h2>導演</h2>
@foreach($product->authors as $author)
    <div><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></div>
@endforeach