<div>
    <h4>Products</h4>
    @foreach($products as $product)
        <img width="300" height="300" src="{{ !$product->cover ?: image_path('cover.product', $product->id, $product->cover) }}">
        <a href="{{ route('products.show', $product->id) }}"><h5>{{ $product->name }}</h5></a>
        <p>{{ $product->description }}</p>
    @endforeach
</div>