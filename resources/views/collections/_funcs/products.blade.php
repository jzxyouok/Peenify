<style>
    #collection {
        cursor: pointer;
    }
</style>

<div id="collection" class="glyphicon glyphicon-book {{ ($collection->products()->where('product_id', $product->id)->exists()) ? 'collection__color' : '' }}"
     data-collection="{{ $collection->id }}" data-id={{ $product->id }} data-token={{ csrf_token() }}>
</div>