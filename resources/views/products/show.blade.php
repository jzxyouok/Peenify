@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/comment.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h1 class="slogan">
                    <!--產品名稱-->
                    {{ $product->name }}
                </h1>
            </div>
        </div>

        <!--圖片-->
        <div class="row">
            <!-- if trailer exist -> show video-->
            <div class="Product__cover">
                <img class="img-responsive" src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/500x300' }}">
            </div>

            <!--site, youtube-->
            {{--<div class="Product__cover">--}}
                {{--<iframe width="500" height="300" src="https://www.youtube.com/embed/i_7ALQz9XFI" frameborder="0" allowfullscreen></iframe>--}}
            {{--</div>--}}

            <!--產品描述-->
            <div class="Product__description">
                {{ $product->description }}
            </div>

            <div class="text-center" style="margin: 0 auto;display: block;max-width:800px;padding: 0.5em 0.5em;">
                發行日期:<p>{{ $product->launched_at }}</p>
            </div>
        </div>

        <!--標籤-->
        @include('products._partials.tags')

        <hr style="max-width: 500px">

        <!--需要登入才可操作項目-->
        @if(auth()->check())
            <div class="form-group text-center">
                <!--評分-->
                @include('products._funcs.emojis')

                <!--願望清單-->
                @include('products._funcs.bookmarks')

                <!--最愛-->
                @include('products._funcs.favorites')

                <!--收藏集-->
                <a href="{{ route('collections.addProduct', $product->id) }}"><i class="glyphicon glyphicon-th-list"></i></a>
            </div>

            <hr style="max-width: 500px">

            <!--評論表單-->
            @if (! auth()->user()->hasBeenCommentByProduct($product->id))
                @include('comments._partials.create')

                <hr style="max-width: 500px">
            @endif

        @endif

            <!--評論清單-->
            @include('comments.lists')
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/favorite.js') }}"></script>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
    <script src="{{ asset('/js/emoji.js') }}"></script>
    <script src="{{ asset('/js/emoji_comment.js') }}"></script>
@endsection