@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">產品名稱</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">產品描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $product->description }}</textarea>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="name">產品網址</label>--}}
                {{--<input type="text" name="site" class="form-control" value="{{ $product->site }}">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="name">產品封面</label>
                <img src="{{ Storage::disk('public')->url("covers/product/" . $product->id . "/" . $product->cover) }}">
                <input type="file" name="cover" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection