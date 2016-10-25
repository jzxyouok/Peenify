<style>
    #favorite {
        cursor: pointer;
    }
</style>

<div id="favorite" class="glyphicon glyphicon-heart{{ $product->isFavorite(auth()->user()) ? ' favorite__color' : '-empty' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
<span id="favorite_amount">
    {{ $product->favorites()->count() }}
</span>
</div>