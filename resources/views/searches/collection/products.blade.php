@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($collection->owns())
            <div class="row" style="margin-bottom: 20px">
                <!--搜尋要加入到收藏集的產品-->
                @include('searches.collection.productbar', [
                    'collection' => $collection
                ])
            </div>
        @endif

        @if ($collection->owns())
            <div style="padding-bottom: 10px;">
                <div class="row">
                    <div class="text-right">
                        <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">Edit</a>
                        <a class="btn btn-default" href="{{ route('collections.confirm.destroy', $collection->id) }}">Delete</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="row" style="margin-bottom: 20px;background-color: #1b6d85;color: #FFFFFF">
            <div class="col-md-4">
                <h1>{{ $collection->name }}</h1>
                <p>{{ $collection->description }}</p>
            </div>

            <div class="col-md-4" style="margin-top: 20px;margin-bottom: 10px;">
                <img class="round Card__image"
                     src="{{ ($collection->user->avatar) ? image_path('avatars.users', $collection->user->avatar):'holder.js/50x50' }}">
                {{ $collection->user->name }}
            </div>

            <div class="col-md-4" style="margin-top: 30px;margin-bottom: 10px;">
                <a class="Card__title__link"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ url(route('collections.show', $collection->id)) }}">
                    <i class="glyphicon glyphicon-share"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    搜尋 {{ $term }} 結果
                </h2>
            </div>
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

                                <span class="Card__option__distance">
                                    <!--收藏集-->
                                    @include('collections._funcs.products')
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

@section('script')
    <script src="{{ asset('/js/masonry-loader.js') }}"></script>
    <script src="{{ asset('/js/favorite.js') }}"></script>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
    <script src="{{ asset('/js/collection.js') }}"></script>
@endsection