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

        #favorite {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">

        <!--collection bar-->
        @include('searches._partials.collectionbar')
        
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h1 class="slogan">
                    搜尋 {{ $term }} 結果
                </h1>
            </div>
        </div>

        <div class="row">
            @foreach($collections as $collection)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel">
                        <h3 class="Card__collection__title">
                            <a class="Card__title__link"
                               href="{{ route('collections.show', $collection->id) }}">{{ str_limit($collection->name, 20) }}
                            </a>
                        </h3>

                        <div id="favorite"
                             class="glyphicon glyphicon-heart{{ $collection->isFavorite(auth()->user()) ? ' favorite__color' : '-empty' }}"
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

        <div class="text-center">
            {!! $collections->appends(['term' => $term])->links('vendor.pagination.simple-default') !!}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/favorite.js') }}"></script>
@endsection