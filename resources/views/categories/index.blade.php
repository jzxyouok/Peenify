@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .Card__panel__category {
            margin-bottom: 20px;
            background-color: #fff;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

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
                    <div class="Card__panel__category" style="border: 1px solid #ccc">
                        <img class="Card__image img-responsive"
                             src="{{ ($category->cover) ? image_path('categories', $category->cover):'holder.js/1280x200' }}">


                        <div>
                            <div class="Card__detail" style="height: auto;">
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
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.subscribe', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                var subscribe = $('#subscribe' + id);
                var subscribe_amount = parseInt(subscribe.find('#amount').text());
                $.post('/subscribes/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'subscribe') {
                        subscribe.find('#amount').html(subscribe_amount + 1);
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消');
                    } else {
                        subscribe.find('#amount').html(subscribe_amount - 1);
                        $this.addClass('btn-default').removeClass('btn-danger').text('訂閱');
                    }
                });
            });
        });
    </script>
@endsection