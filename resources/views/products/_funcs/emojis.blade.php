<style>
    .emoji {
        cursor: pointer;
        padding-right: 15px;
    }

    .amount {
    }
</style>

<div id="like" class="emoji fa fa-thumbs-{{ $product->isEmoji(auth()->user(), 'like') ? 'up like__color' : 'o-up' }}"
     data-type="product" data-emoji="like" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('like') }}
    </span>
</div>

<div id="bad" class="emoji fa fa-thumbs-{{ $product->isEmoji(auth()->user(), 'bad') ? 'down bad__color' : 'o-down' }}"
     data-type="product" data-emoji="bad" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span class="amount">
        {{ $product->countEmoji('bad') }}
    </span>
</div>
