<h3>演員</h3>
@foreach($product->actors as $actor)
    <div><a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a></div>
@endforeach