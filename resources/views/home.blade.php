@extends('layouts.app')

@inject('subscribe', 'App\Services\SubscribeService')

@section('style')
    <style>
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if (! $subscribe->existSubscribe('category', auth()->user()))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">儀表板</div>

                        <div class="panel-body">
                            <div class="text-center">
                                Oops! 你尚未訂閱任何類別，請先去訂閱類別才能推薦給你專屬的產品。
                                <a class="btn btn-default" href="{{ route('categories.index') }}">前往訂閱類別</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 text-center slogan__distance">
                    <h3 class="slogan">
                        For you...
                    </h3>
                </div>
            </div>

            <div class="row grid">
                @foreach($products = $subscribe->forUserProducts(auth()->user()) as $product)
                    <div class="grid-item col-xs-12 col-sm-8 col-md-4 col-lg-4">
                        <div class="Card__panel">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img class="Card__image img-responsive"
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
                {!! $products->links('vendor.pagination.simple-default') !!}
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/masonry-loader.js') }}"></script>
    <script src="{{ asset('/js/favorite.js') }}"></script>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
@endsection
