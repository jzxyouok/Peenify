<style>
    .bookmark {
        cursor: pointer;
    }
</style>

<div class="bookmark fa fa-bookmark{{ $product->isBookmark(auth()->user()) ? ' bookmark__color' : '-o' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span id="bookmark_amount">
        {{ $product->bookmarks()->count() }}
    </span>
</div>