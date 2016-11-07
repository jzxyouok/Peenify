<div class="text-center">
    @foreach($product->tags as $tag)
        <span class="Product__tag">
            {{ $tag->name }}
        </span>
    @endforeach
</div>