@extends('layouts.app')

@section('content')

    <div class="container">
        <img src="{{ !$product->cover ?: image_path('cover.product', $product->id, $product->cover) }}">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>

        <a class="btn btn-default" href="{{ route('products.edit', $product->id) }}">Edit</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>


        @include('products._partials.emojis', [
            'type' => 'product',
            'id' => $product->id,
        ])

        @include('comments._partials.create', [
            'commentable_type' => 'product',
            'commentable_id' => $product->id,
        ])

        @include('comments._partials.show', [
            'comments' => $product->comments
        ])
    </div>

@endsection