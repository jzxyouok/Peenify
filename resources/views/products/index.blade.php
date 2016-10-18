@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
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
                                    <a class="Card__title__link" href="{{ route('products.show', $product->id) }}">{{ str_limit($product->name, 20) }}
                                    </a>
                                </h3>

                                <div class="Card__count">
                                    {{ $product->emojis()->count() }}
                                    <span class="Card__count__description">評價</span>
                                </div>
                            </div>
                        </div>

                        <div class="Card__option">
                            <span style="padding-right: 5px;">
                                <i class="glyphicon glyphicon-heart"></i>
                                10
                            </span>

                            <span style="padding-right: 5px;">
                                <i class="glyphicon glyphicon-comment"></i>
                                {{ $product->comments()->count() }}
                            </span>

                            <i class="glyphicon glyphicon-share"></i>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center">
            {!! $products->links('vendor.pagination.simple-default') !!}
        </div>

    </div>
@endsection