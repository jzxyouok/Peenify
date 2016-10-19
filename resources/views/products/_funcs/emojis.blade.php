{{--<div id="emoji" class="btn btn-{{ $product->isEmoji(auth()->user(), 'like') ? 'danger' : 'default' }}"--}}
     {{--data-type="product" data-emoji="like"--}}
     {{--data-id={{ $product->id }} data-token={{ csrf_token() }}> 喜歡--}}
    {{--（{{ $product->countEmoji(auth()->user(), 'like') }}）--}}
{{--</div>--}}

<div id="emoji_like" class="emoji glyphicon glyphicon-thumbs-up{{ $product->isEmoji(auth()->user(), 'like') ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-emoji="like" data-id={{ $product->id }} data-token={{ csrf_token() }}>
<span id="emoji_like_amount">
    {{ $product->countEmoji(auth()->user(), 'like') }}
</span>
</div>

<div id="emoji_bad" class="emoji glyphicon glyphicon-thumbs-down{{ $product->isEmoji(auth()->user(), 'bad') ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-emoji="bad" data-id={{ $product->id }} data-token={{ csrf_token() }}>
<span id="emoji_bad_amount">
    {{ $product->countEmoji(auth()->user(), 'bad') }}
</span>
</div>