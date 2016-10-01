<div class="form-group">
    <div id="wish" class="btn btn-{{ $product->existWishByAuth() ? 'danger' : 'default' }}"
         data-id={{ $product->id }} data-token={{ csrf_token() }}>
        {{ $product->existWishByAuth() ? '從願望清單移除' : '加到願望清單'}}
    </div>
</div>