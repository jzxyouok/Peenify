@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    評分紀錄
                </h2>
            </div>
        </div>

        <div class="row grid">
            @foreach($emojis as $emoji)
                    <div class="grid-item col-xs-12 col-sm-8 col-md-4 col-lg-4">
                        <div class="Card__panel">
                            <a href="{{ route('products.show', $emoji->emojiable->id) }}">
                                <img class="Card__image img-responsive"
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
                                            <span class="like__color fa fa-thumbs-up fa-lg"></span>
                                        @else
                                            <span class="bad__color fa fa-thumbs-down fa-lg"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

            <div class="text-center">
                {!! $emojis->links('vendor.pagination.simple-default') !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection