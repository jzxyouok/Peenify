@inject('collections', 'App\Services\CollectionService')

<div class="form-group">
    <form method="post" action="{{ route('collections.addProduct', $product->id) }}">
        {{ csrf_field() }}
        <div class="col-md-4">
            <select class="form-control" name="collection_id">
                @foreach($collections->getAllByAuth() as $collection)
                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                @endforeach
            </select>
        </div>
        <input class="btn btn-default" type="submit" value="加入到此收藏集">
    </form>
    有 {{ $product->collections()->count() }} 個收藏集收藏此產品。
</div>