@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .icon__distance {
            margin: 10px 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 text-center" style="padding-bottom: 20px">
            <h2 class="Card__category__name">
                最新產品
            </h2>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel" style="border: 1px solid #ccc">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img class="Card__image"
                                 src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/380x260?auto=yes' }}">
                        </a>

                        <div>
                            <div class="Card__detail">
                                <h3 class="Card__title">
                                    <a class="Card__title__link"
                                       href="{{ route('products.show', $product->id) }}">{{ str_limit($product->name, 20) }}
                                    </a>
                                </h3>

                                <div class="Card__count">
                                    {{ $product->emojis()->count() }}
                                    <span class="Card__count__description">評價</span>
                                </div>
                            </div>
                        </div>

                        @if (auth()->check())
                            <div class="Card__option">
                            <span class="icon__distance">
                                @include('products._funcs.bookmarks')
                            </span>

                                <span class="icon__distance">
                                @include('products._funcs.favorites')
                            </span>

                                <span class="icon__distance">
                                <i class="glyphicon glyphicon-comment"></i>
                                    {{ $product->comments()->count() }}
                            </span>

                                <i class="glyphicon glyphicon-share"></i>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center">
            {!! $products->links('vendor.pagination.simple-default') !!}
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#favorite', function () {
                var $this = $(this);
                var $amount = parseInt($this.find('#favorite_amount').text());
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/favorites/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'favorite') {
                        $this.addClass('glyphicon-heart').addClass('Favorite__heart__color').removeClass('glyphicon-heart-empty');
                        $this.find('#favorite_amount').html($amount + 1);
                    } else {
                        $this.addClass('glyphicon-heart-empty').removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                        $this.find('#favorite_amount').html($amount - 1);
                    }
                });
            });

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
                        $this.addClass('Favorite__heart__color');
                        $this.find('#bookmark_amount').html($amount + 1);
                    } else {
                        $this.removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                        $this.find('#bookmark_amount').html($amount - 1);
                    }
                });
            });
        });
    </script>
@endsection