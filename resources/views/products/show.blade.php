@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        h1 {
            border-bottom: 1px solid #000000;
            display: inline-block;
        }

        .cover {
            width: 500px;
            max-height: 300px;
            display: block;
            margin: 0 auto;
            padding-bottom: 10px;
        }

        .description {
            margin: 0 auto;
            display: block;
            max-width: 500px;
            padding: 0.5em 0.5em;
            text-align: justify;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="padding-bottom: 20px;">
            <!--產品名稱-->
            <h1>{{ $product->name }}</h1>
        </div>

        <!--圖片-->
        <div class="row">
            <img class="cover img-responsive"
                 src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/500x300' }}">

            <!--site, youtube-->
            <div class="text-center">

            </div>

            <!--產品描述-->
            <div class="description">
                {{ $product->description }}
            </div>

            <div class="text-center" style="margin: 0 auto;display: block;max-width:800px;padding: 0.5em 0.5em;">
                發行日期:<p>{{ $product->launched_at }}</p>
            </div>
        </div>

        <!--標籤-->
    @include('products._partials.tags')

    <!--需要登入才可操作項目-->
        @if(auth()->check())
            <div class="form-group text-center">
                <!--評分-->
                @include('products._funcs.emojis')
            </div>

            <div class="form-group text-center">
                <!--收藏集-->
                <a class="btn btn-default" href="{{ route('collections.addProduct', $product->id) }}">加入收藏集</a>

                <!--願望清單-->
                @include('products._funcs.bookmarks')

            <!--最愛-->
                @include('products._funcs.favorites')
            </div>

            <!--評論表單-->
            @if (! auth()->user()->hasBeenCommentByProduct($product->id))
                @include('comments._partials.create')
            @endif

            <!--評論清單-->
            @include('comments.lists')
        @endif
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#bookmark', function () {
                var $this = $(this);
                var $amount = parseInt($this.find('#bookmark_amount').text());
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/bookmarks/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'bookmark') {
                        $this.addClass('Favorite__heart__color').find('#bookmark_amount').html($amount + 1);
                    } else {
                        $this.removeClass('Favorite__heart__color').find('#bookmark_amount').html($amount - 1);
                    }
                });
            });

            $(document).on('click', '.emoji', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                var emoji = $this.data('emoji');
                var amount = parseInt($this.find('.amount').text());

                var bad = $('#bad');
                var bad_amount = parseInt(bad.find('.amount').text());
                var like = $('#like');
                var like_amount = parseInt(like.find('.amount').text());
                $.post('/emojis/' + type + '/' + id, {
                    '_token': token,
                    'emoji': emoji
                }, function (result) {
                    if (result.status == 'emoji') {
                        $this.find('.amount').html(amount + 1);
                        $this.addClass('Favorite__heart__color');
                    } else if (result.status == 'updateEmoji') {
                        if (emoji == 'like') {
                            bad.removeClass('Favorite__heart__color').find('.amount').html(bad_amount - 1);
                        } else {
                            like.removeClass('Favorite__heart__color').find('.amount').html(like_amount - 1);
                        }

                        $this.addClass('Favorite__heart__color');
                        $this.find('.amount').html(parseInt($this.find('.amount').text()) + 1);
                    } else {
                        $this.find('.amount').html(amount - 1);
                        $this.removeClass('Favorite__heart__color');
                    }
                });
            });

            $(document).on('click', '#favorite', function () {
                var $this = $(this);
                var amount = parseInt($('#favorite_amount').text());
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/favorites/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'favorite') {
                        $this.addClass('glyphicon-heart').addClass('Favorite__heart__color').removeClass('glyphicon-heart-empty');
                        $('#favorite_amount').html(amount + 1);
                    } else {
                        $this.addClass('glyphicon-heart-empty').removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                        $('#favorite_amount').html(amount - 1);
                    }
                });
            });
        });


        $(document).ready(function () {
            $(document).on('click', '.emoji_comment', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                var emoji = $this.data('emoji');
                var amount = parseInt($this.find('.amount').text());

                var bad = $('#bad_comment' + id);
                var bad_amount = parseInt(bad.find('.amount').text());
                var like = $('#like_comment' + id);
                var like_amount = parseInt(like.find('.amount').text());
                $.post('/emojis/' + type + '/' + id, {
                    '_token': token,
                    'emoji': emoji
                }, function (result) {
                    if (result.status == 'emoji') {
                        $this.find('.amount').html(amount + 1);
                        $this.addClass('Favorite__heart__color');
                    } else if (result.status == 'updateEmoji') {
                        if (emoji == 'like') {
                            bad.removeClass('Favorite__heart__color').find('.amount').html(bad_amount - 1);
                        } else {
                            like.removeClass('Favorite__heart__color').find('.amount').html(like_amount - 1);
                        }

                        $this.addClass('Favorite__heart__color');
                        $this.find('.amount').html(parseInt($this.find('.amount').text()) + 1);
                    } else {
                        $this.find('.amount').html(amount - 1);
                        $this.removeClass('Favorite__heart__color');
                    }
                });
            });
        });
    </script>
@endsection