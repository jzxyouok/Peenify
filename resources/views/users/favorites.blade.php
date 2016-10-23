@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .Card__panel {
            height: auto;
        }

        #favorite {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="col-md-12 text-center" style="padding-bottom: 20px">
            <h2 class="Card__category__name">
                {{ $user->name }}'s 最愛
            </h2>
        </div>

        <div class="row">

            @foreach($favorites as $favorite)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel" style="border: 1px solid #ccc">
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
                                             class="glyphicon glyphicon-heart{{ $favorite->favorable->isFavorite(auth()->user()) ? ' Favorite__heart__color' : '-empty' }}"
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
                </div>
            @endforeach
        </div>

        {!! $favorites->links() !!}
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#favorite', function () {
                var $this = $(this);
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/favorites/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'favorite') {
                        $this.addClass('glyphicon-heart').addClass('Favorite__heart__color').removeClass('glyphicon-heart-empty');
                    } else {
                        $this.addClass('glyphicon-heart-empty').removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                    }
                });
            });
        });
    </script>
@endsection