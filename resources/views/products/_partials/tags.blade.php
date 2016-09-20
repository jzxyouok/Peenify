<div>
    <i class="glyphicon glyphicon-tags"></i>
    @foreach($product->tags as $tag)
        <div class="label label-default"><a id="tag-link" href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></div>
        <span class="badge">
            {{ $tag->count }}
        </span>
    @endforeach
</div>