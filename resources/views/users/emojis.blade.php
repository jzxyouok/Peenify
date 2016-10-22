@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .Card__panel {
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 text-center" style="padding-bottom: 20px">
            <h2 class="Card__category__name">
                評分紀錄
            </h2>
        </div>
        <div class="row">
            @foreach($emojis as $emoji)
                @if ($emoji->emojiable_type == 'product')
                    <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                        <div class="Card__panel" style="border: 1px solid #ccc">
                            <a href="{{ route('products.show', $emoji->emojiable->id) }}">
                                <img class="Card__image"
                                     src="{{ ($emoji->emojiable->cover) ? image_path('products', $emoji->emojiable->cover):'holder.js/380x260?auto=yes' }}">
                            </a>

                            <div>
                                <div class="Card__detail">
                                    <h3 class="Card__title">
                                        <a class="Card__title__link"
                                           href="{{ route('products.show', $emoji->emojiable->id) }}">{{ str_limit($emoji->emojiable->name, 20) }}
                                        </a>
                                    </h3>

                                    <div class="Card__count">
                                        @if ($emoji->type == 'like')
                                            <span style="color: green;" class="glyphicon glyphicon-thumbs-up"></span>
                                        @else
                                            <span style="color: red;" class="glyphicon glyphicon-thumbs-down"></span>
                                        @endif
                                    </div>

                                    <div class="Card__count">
                                        {{ $emoji->emojiable->emojis()->count() }}
                                        <span class="Card__count__description">評價</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div style="text-align: center">
                {!! $emojis->links('vendor.pagination.simple-default') !!}
            </div>
        </div>
    </div>
@endsection