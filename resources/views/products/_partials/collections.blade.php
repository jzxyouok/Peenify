<div>有 {{ $product->collections()->count() }} 把此產品加入收藏了。</div>

@if (auth()->check())
    此產品已經存在於....
    @foreach($product->collections()->where('user_id', auth()->user()->id)->get() as $collection)
        {{ $collection->name }}
    @endforeach
@endif