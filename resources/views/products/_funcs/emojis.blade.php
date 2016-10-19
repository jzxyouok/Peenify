<style>
    .amount {

    }
</style>

<div id="like" class="emoji glyphicon glyphicon-thumbs-up{{ $product->isEmoji(auth()->user(), 'like') ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-emoji="like" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('like') }}
    </span>
</div>

<div id="bad" class="emoji glyphicon glyphicon-thumbs-down{{ $product->isEmoji(auth()->user(), 'bad') ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-emoji="bad" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('bad') }}
    </span>
</div>
