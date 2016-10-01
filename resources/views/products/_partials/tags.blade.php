<div class="form-group">
    <i class="glyphicon glyphicon-tags"></i>
    @foreach($product->tags as $tag)
        <div class="label label-default">
            <a style="text-decoration: none;color: #FFFFFF" href="{{ route('tags.show', $tag->id) }}">
                {{ $tag->name }} ({{ $tag->count }})
            </a>
        </div>
    @endforeach
</div>