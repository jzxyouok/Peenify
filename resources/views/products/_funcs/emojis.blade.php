<div class="form-group">
    <div id="emoji" class="btn btn-{{ $product->isEmoji(auth()->user(), 'like') ? 'danger' : 'default' }}"
         data-type="product" data-emoji="like"
         data-id={{ $product->id }} data-token={{ csrf_token() }}> 喜歡
        （{{ $product->countEmoji(auth()->user(), 'like') }}）
    </div>

    <div id="emoji" class="btn btn-{{ $product->isEmoji(auth()->user(), 'bad') ? 'danger' : 'default' }}"
         data-type="product" data-emoji="bad"
         data-id={{ $product->id }} data-token={{ csrf_token() }}> 不喜歡
        （{{ $product->countEmoji(auth()->user(), 'bad') }}）
    </div>
</div>