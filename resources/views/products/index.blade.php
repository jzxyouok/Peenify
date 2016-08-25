@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Products</h1>
        @foreach($products as $product)
            <h3><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h3>
            <p>{{ $product->description }}</p>
            <p>{{ $product->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection