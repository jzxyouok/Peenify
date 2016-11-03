@extends('layouts.app')

@section('style')
    <style>
        #favorite {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    {{ $user->name }}'s 最愛
                </h2>
            </div>
        </div>

        <div class="row grid">
            @foreach($favorites as $favorite)
                <div class="grid-item col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    @if($favorite->favorable instanceof \App\Collection)
                        <div class="Card__panel">
                            {{ $favorite->favorable->name }}
                        </div>
                    @else
                        <div class="Card__panel">
                            <a href="{{ route('products.show', $favorite->favorable->id) }}">
                                <img class="Card__image"
                                     src="{{ ($favorite->favorable->cover) ? image_path('products', $favorite->favorable->cover):'holder.js/380x260?auto=yes' }}">
                            </a>

                            <div>
                                <div class="Card__detail">
                                    <h3 class="Card__title">
                                        <a class="Card__title__link"
                                           href="{{ route('products.show', $favorite->favorable->id) }}">{{ str_limit($favorite->favorable->name, 20) }}
                                        </a>
                                    </h3>

                                    @if(auth()->check() && $favorite->owns())
                                        <div class="Card__count">
                                            <div id="favorite"
                                                 class="glyphicon glyphicon-heart{{ $favorite->favorable->isFavorite(auth()->user()) ? ' favorite__color' : '-empty' }}"
                                                 data-type="product"
                                                 data-id={{ $favorite->favorable->id }} data-token={{ csrf_token() }}>
                                            </div>

                                            <span class="Card__count__description">
                                            {{ $favorite->created_at->diffForHumans() }}
                                        </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $favorites->links() !!}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/masonry-loader.js') }}"></script>
    <script src="{{ asset('/js/favorite.js') }}"></script>
@endsection