@if (! $product->actors->isEmpty())
    @foreach($product->actors as $actor)
        <div>
            <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
        </div>
    @endforeach
@endif