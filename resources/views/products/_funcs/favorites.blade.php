<div id="favorite" class="glyphicon glyphicon-heart{{ $product->isFavorite(auth()->user()) ? ' Favorite__heart__color' : '-empty' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
</div>

<span id="favorite_amount">
    {{ $product->favorites()->count() }}
</span>