@extends('layouts.app')

@section('style')
    <style>
        .round {
            border-radius: 50%;
            overflow: hidden;
            width: 50px;
            height: 50px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!--搜尋要加入到收藏集的產品-->
            @include('searches.collection.productbar', [
                'collection' => $collection
            ])
        </div>

        <div class="row" style="padding-bottom: 20px">
            <div style="background-color: #1b6d85;color: #FFFFFF">
                <h1>{{ $collection->name }}</h1>
                <p>{{ $collection->description }}</p>

                <div>
                    <div class="round">
                        <img class="Card__image"
                             src="{{ ($collection->user->avatar) ? image_path('avatars.users', $collection->user->avatar):'holder.js/50x50' }}">
                    </div>
                    {{ $collection->user->name }}
                </div>

                <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">Edit</a>

                <form action="{{ route('collections.destroy', $collection->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="delete" class="btn btn-danger">
                </form>

                <a class="Card__title__link"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ url(route('collections.show', $collection->id)) }}">
                    <i class="glyphicon glyphicon-share"></i>
                </a>
            </div>
        </div>

        <div class="row grid">
            @foreach($collection->products()->get() as $product)
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
                                    <!--收藏集-->
                                    @include('collections._funcs.products')
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/masonry-loader.js') }}"></script>
    <script src="{{ asset('/js/favorite.js') }}"></script>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
    <script src="{{ asset('/js/collection.js') }}"></script>
@endsection