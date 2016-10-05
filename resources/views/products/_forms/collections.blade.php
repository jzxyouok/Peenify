@inject('collections', 'App\Services\CollectionService')

@if ($collections->findByUser(auth()->user()->id)->isEmpty())
    還沒有收藏集嗎？
    <div class="form-group">
        <a class="btn btn-default" href="{{ route('collections.create') }}">建立收藏集</a>
    </div>
@else
    <div class="form-group">
        <form method="post" action="{{ route('collections.addProduct', $product->id) }}">
            {{ csrf_field() }}
            <div class="col-md-4">
                <select class="form-control" name="collection_id">
                    @foreach($collections->findByUser(auth()->user()->id) as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input class="btn btn-default" type="submit" value="加入到此收藏集">
            </div>
        </form>
        有 {{ $product->collections()->count() }} 個收藏集收藏此產品。
    </div>
@endif
