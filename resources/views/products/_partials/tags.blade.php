<div>
    @foreach($product->tags as $tag)
        <div class="label label-default">{{ $tag->name }}</div><span class="badge">{{ $tag->count }}</span>
    @endforeach
</div>