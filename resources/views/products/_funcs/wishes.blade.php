<div id="wish" class="glyphicon glyphicon-bookmark{{ $product->isWish(auth()->user()) ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
<span id="wish_amount">
    {{ $product->wishes()->count() }}
</span>
</div>