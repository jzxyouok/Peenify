<style>
    .emoji {
        cursor: pointer;
        padding-right: 15px;
    }

    .amount {
    }
</style>

<div id="like" class="emoji glyphicon glyphicon-thumbs-up{{ $product->isEmoji(auth()->user(), 'like') ? ' like__color' : '' }}"
     data-type="product" data-emoji="like" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('like') }}
    </span>
</div>

<div id="bad" class="emoji glyphicon glyphicon-thumbs-down{{ $product->isEmoji(auth()->user(), 'bad') ? ' bad__color' : '' }}"
     data-type="product" data-emoji="bad" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('bad') }}
    </span>
</div>
