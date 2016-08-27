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


        {{--<!--明天想個辦法做抽離跟調整-->--}}
        {{--<form action="{{ route('emojis.sync', ['emojiable_type' => 'product', 'emojiable_id' => $product->id]) }}" method="post">--}}
            {{--{{ csrf_field() }}--}}
            {{--<h3>Like: {{ $product->emojis()->where('type', 'like')->count() }}</h3>--}}
            {{--<h3>Normal: {{ $product->emojis()->where('type', 'normal')->count() }}</h3>--}}
            {{--<h3>Bad: {{ $product->emojis()->where('type', 'bad')->count() }}</h3>--}}
            {{--<input type="radio" name="type" value="like"> Like <br />--}}
            {{--<input type="radio" name="type" value="normal"> Normal <br />--}}
            {{--<input type="radio" name="type" value="bad"> Bad <br />--}}
            {{--<input type="submit" value="評分" class="btn btn-danger">--}}
        {{--</form>--}}
        {{--<!-- user -->--}}

        {{--@include('comments._partials.create', [--}}
            {{--'product_id' => $product->id--}}
        {{--])--}}

        {{--@include('comments._partials.show', [--}}
            {{--'comments' => $comments,--}}
            {{--'product_id' => $product->id,--}}
        {{--])--}}
    </div>

@endsection