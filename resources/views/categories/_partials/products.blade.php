<div>
    <h4>Products</h4>
    @foreach($products as $product)
        <h5>{{ $product->name }}</h5>
        <p>{{ $product->description }}</p>
    @endforeach
</div>