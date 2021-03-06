@extends('layouts.app')

@section('facebook_meta')
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:url" content="{{ route('products.show', $product->id) }}"/>
    <meta property="og:description" content="{{ $product->description }}"/>
    <meta property="og:site_name" content="Peenify"/>
    <meta property="og:image"
          content="{{ ($product->cover) ? image_path('products', $product->cover):'http://i.imgur.com/eCWz6hF.png' }}"/>
    <meta property="og:image:width" content="660" />
    <meta property="og:image:height" content="440" />
    <meta property="og:locale" content="zh_TW"/>
@endsection

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
                @if (! empty($product->options['trailer']))
                    <div id="js-player" class="video-container" data-type="youtube" data-video-id="{{ $product->options['trailer'] }}"></div>
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
                發行日期:<p>{{ parse_time($product->created_at) }}</p>
            </div>
        </div>

        <!--標籤-->
        @include('products._partials.tags')

        <!--需要登入才可操作項目-->
        @if(auth()->check())
            <hr style="max-width: 500px">

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
        });

        plyr.setup('#js-player');
    </script>
@endsection