@extends('layouts.app')

@section('style')
    <style>
        .subscribe {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 20px;padding-right: 20px;">
                    <div class="Card__panel">
                        <img class="Card__image img-responsive"
                             src="{{ ($category->cover) ? image_path('categories', $category->cover):'holder.js/1280x200' }}">


                            <div class="Card__detail">
                                <h3 class="Card__title">
                                    <a class="Card__title__link"
                                       href="{{ route('categories.show', $category->id) }}">{{ str_limit($category->name, 20) }}
                                    </a>
                                </h3>

                                <div class="Card__count">
                                    {{ $category->products()->count() }}
                                    <span class="Card__count__description">產品</span>
                                </div>

                                <div id="subscribe{{ $category->id }}" class="Card__count">
                                    <span id="amount">{{ $category->subscribes()->count() }}</span>
                                    <span class="Card__count__description">訂閱數</span>
                                </div>

                                @if(auth()->check())
                                    <div class="Card__count">
                                            <span class="subscribe btn btn-{{ $category->isSubscribe(auth()->user()) ? 'danger' : 'default' }}"
                                                  data-type="category"
                                                  data-id={{ $category->id }} data-token={{ csrf_token() }}>
                                                    {{ $category->isSubscribe(auth()->user()) ? '取消' : '訂閱' }}
                                            </span>
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('/js/subscribe.js') }}"></script>
@endsection