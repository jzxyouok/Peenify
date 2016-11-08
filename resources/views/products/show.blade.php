@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/comment.css') }}">
@endsection

@section('content')
    <div class="container" id="app">
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
            <div class="Product__cover">
                <!-- if trailer exist -> show video-->
                @if (! empty($product->movie->trailer))
                    <iframe width="500" height="300" src="https://www.youtube.com/embed/{{ $product->movie->trailer }}" frameborder="0"
                            allowfullscreen></iframe>
                @else
                    <img class="img-responsive"
                         src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/500x300' }}">
                @endif
            </div>

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
            </div>

            <hr style="max-width: 500px">

            <!--評論表單-->
            @if (! auth()->user()->hasBeenCommentByProduct($product->id))
                @include('comments._partials.create')
            @endif

        @endif

        <!--評論清單-->
        <hr style="max-width: 500px">
        @if ($product->comments()->exists())
            @include('comments.lists')
        @else
            <div class="text-center">
                <h3>目前尚未有評論 :(</h3>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                comment: ''
            },
            computed: {
                comment_surplus: function () {
                    return 200 - this.comment.length
                }
            }
        })
    </script>
@endsection