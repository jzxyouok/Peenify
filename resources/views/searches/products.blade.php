@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    搜尋 {{ $term }} 結果
                </h2>
            </div>
        </div>

        <!--search bar-->
        <div class="row Searchbar__distance">
            @include('searches._partials.productbar')
        </div>

        <div class="row grid">
            @foreach($products as $product)
                <div class="grid-item col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img class="Card__image img-responsive"
                                 src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/380x260?auto=yes' }}">
                        </a>

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

                        @if (auth()->check())
                            <div class="Card__option">
                                <span class="Card__option__distance">
                                    @include('products._funcs.bookmarks')
                                </span>

                                <span class="Card__option__distance">
                                    @include('products._funcs.favorites')
                                </span>

                                <span class="Card__option__distance">
                                    <i class="glyphicon glyphicon-comment"></i>
                                    {{ $product->comments()->count() }}
                                </span>

                                <a class="Card__title__link"
                                   href="https://www.facebook.com/sharer/sharer.php?u={{ url(route('products.show', $product->id)) }}">
                                    <i class="glyphicon glyphicon-share"></i>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $products->appends(['term' => $term])->links('vendor.pagination.simple-default') !!}
        </div>

    </div>
@endsection