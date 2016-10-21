@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .Card__panel__collection {
            margin-bottom: 20px;
            background-color: #fff;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .Collection__title {
            display: inline-block;
            margin-left: 10px;
        }

        .Collection_description {
            margin: 0;
            -webkit-box-flex: 1;
            flex: 1;
        }

        #favorite {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="padding-bottom: 20px">
                <h2 class="Card__category__name">
                    為您精選收藏集
                </h2>
            </div>

            <div class="row">
                @foreach($collections as $collection)
                    <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                        <div class="Card__panel__collection" style="border: 1px solid #ccc">
                            <h3 class="Collection__title">
                                <a class="Card__title__link"
                                   href="{{ route('collections.show', $collection->id) }}">{{ str_limit($collection->name, 20) }}
                                </a>
                            </h3>

                            <div id="favorite" class="glyphicon glyphicon-heart{{ $collection->isFavorite(auth()->user()) ? ' Favorite__heart__color' : '-empty' }}"
                                 data-type="collection" data-id={{ $collection->id }} data-token={{ csrf_token() }}>
                                    <span id="favorite_amount">
                                        {{ $collection->favorites()->count() }}
                                    </span>
                            </div>

                                <div class="Card__detail">
                                    <div class="Collection_description">
                                        {{ str_limit($collection->description, 20) }}
                                    </div>

                                    <div class="Card__count">
                                        {{ $collection->products()->count() }}
                                        <span class="Card__count__description">產品</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="text-align: center">
                {!! $collections->links() !!}
            </div>
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
        });
    </script>
@endsection