<form method="post" action="{{ route('collections.addProduct', $product->id) }}">
    {{ csrf_field() }}
    <div class="col-md-4">
        <select class="form-control" name="collection_id">
            @foreach($collections as $collection)
                <option value="{{ $collection->id }}">{{ $collection->name }}</option>
            @endforeach
        </select>
    </div>
    <input class="btn btn-default" type="submit" value="加入到此收藏集">
</form>

此產品已經存在於....
@foreach($product->collections()->where('user_id', auth()->user()->id)->get() as $collection)
{{ $collection->name }}
@endforeach