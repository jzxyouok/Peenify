<h2>導演</h2>
@foreach($product->authors as $author)
    <div>{{ $author->name }}</div>
@endforeach