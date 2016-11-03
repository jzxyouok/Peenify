<style>
    .favorite {
        cursor: pointer;
    }
</style>

<div class="favorite fa fa-heart{{ $product->isFavorite(auth()->user()) ? ' favorite__color' : '-o' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
<span id="favorite_amount">
    {{ $product->favorites()->count() }}
</span>
</div>