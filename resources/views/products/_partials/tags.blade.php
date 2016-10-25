<div class="text-center">
    @foreach($product->tags as $tag)
        <a class="Product__tag" href="{{ route('tags.show', $tag->id) }}">
            {{ $tag->name }}
        </a>
    @endforeach
</div>