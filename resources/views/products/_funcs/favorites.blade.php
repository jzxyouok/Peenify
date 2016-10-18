<div id="favorite" class="glyphicon glyphicon-heart{{ $product->isFavorite(auth()->user()) ? '-empty' : '' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
</div>