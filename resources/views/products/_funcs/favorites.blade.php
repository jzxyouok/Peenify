<div class="form-group">
    <div id="favorite" class="btn btn-{{ $product->existFavoriteByAuth() ? 'danger' : 'default' }}"
         data-id={{ $product->id }} data-token={{ csrf_token() }}>
        {{ $product->existWishByAuth() ? '取消最愛' : '最愛'}}
    </div>
</div>