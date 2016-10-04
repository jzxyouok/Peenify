<div class="form-group">
    <div id="favorite" class="btn btn-{{ $product->isFavorite(auth()->user()) ? 'danger' : 'default' }}"
         data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
        {{ $product->isFavorite(auth()->user()) ? '取消最愛' : '最愛'}}
    </div>
</div>