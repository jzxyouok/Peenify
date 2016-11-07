@extends('layouts.app')

@section('style')
    <style>
        .Card__panel {
            height: auto;
        }

        .Collection_description {
            margin: 0;
            -webkit-box-flex: 1;
            flex: 1;
        }

        .favorite {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    {{ $user->name }}'s 最愛收藏集
                </h2>
            </div>
        </div>

        <div class="row">
            @foreach($favorites as $favorite)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel">
                        <h3 class="Card__collection__title">
                            <a class="Card__title__link"
                               href="{{ route('collections.show', $favorite->favorable->id) }}">{{ str_limit($favorite->favorable->name, 20) }}
                            </a>
                        </h3>

                        @if (auth()->check())
                            <div class="favorite fa fa-heart{{ $favorite->favorable->isFavorite(auth()->user()) ? ' favorite__color' : '-o' }}"
                                 data-type="collection" data-id={{ $favorite->favorable->id }} data-token={{ csrf_token() }}>
                                <span id="favorite_amount">
                                    {{ $favorite->favorable->favorites()->count() }}
                                </span>
                            </div>
                        @endif

                        <div class="Card__detail">
                            <div class="Collection_description">
                                {{ str_limit($favorite->favorable->description, 20) }}
                            </div>

                            <div class="Card__count">
                                {{ $favorite->favorable->products()->count() }}
                                <span class="Card__count__description">產品</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $favorites->links() !!}
        </div>
    </div>
@endsection