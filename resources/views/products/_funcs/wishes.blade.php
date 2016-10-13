<div id="wish" class="btn btn-{{ $product->isWish(auth()->user()) ? 'danger' : 'default' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    {{ $product->isWish(auth()->user()) ? '從願望清單移除' : '加到願望清單'}}
</div>