<style>
    #bookmark {
        cursor: pointer;
    }
</style>

<div id="bookmark" class="glyphicon glyphicon-bookmark{{ $product->isBookmark(auth()->user()) ? ' Favorite__heart__color' : '' }}"
     data-type="product" data-id={{ $product->id }} data-token={{ csrf_token() }}>
    <span id="bookmark_amount">
        {{ $product->bookmarks()->count() }}
    </span>
</div>