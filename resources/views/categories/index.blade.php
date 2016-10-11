@extends('layouts.app')

@section('style')
    <style>
        .subscribe {

        }

        .Card__details {
            box-sizing: border-box;
            background: rgb(255, 255, 255);
            padding: 8px 12px;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
        }

        .Card__title {
            box-sizing: border-box;
            line-height: 1.3em;
            color: rgb(80, 91, 105);
            margin: 0px;
            font-size: 17px;
            -webkit-box-flex: 1;
            flex: 110%;
        }

        .link_style {
            box-sizing: border-box;
            background-color: transparent;
            text-decoration: none;
        }

        .Card__count {
            box-sizing: border-box;
            font-weight: 600;
            text-align: right;
            font-size: 22px;
            padding-left: 10px;
        }

        .utility-muted {
            box-sizing: border-box;
            color: rgb(155, 166, 181);
            font-weight: 400;
            display: block;
            font-size: 13px;
            margin-top: -5px;
        }
    </style>
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($categories as $category)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <img style="max-width: 100%;"
                                 src="{{ ($category->cover) ? image_path('categories', $category->cover):'holder.js/1264x200' }}">

                            <div class="panel-title">
                                <div class="Card__details">
                                    <h3 class="Card__title" style="font-size: 24px;">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                           class="link_style">{{ str_limit($category->name, 20) }}
                                        </a>
                                    </h3>
                                    @if(auth()->check())
                                        <div class="Card__count">
                                            <span class="subscribe btn btn-{{ $category->isSubscribe(auth()->user()) ? 'danger' : 'default' }} btn-lg"
                                                  data-type="category"
                                                  data-id={{ $category->id }} data-token={{ csrf_token() }}>
                                                    {{ $category->isSubscribe(auth()->user()) ? '取消訂閱' : '訂閱' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="Card__details">
                                    <div class="Card__title">
                                        {{ $category->description }}
                                    </div>

                                    <div class="Card__count">
                                        {{ $category->products()->count() }}
                                        <span class="utility-muted">Products</span>
                                    </div>

                                    <div class="Card__count">
                                        <div>
                                            {{ $category->subscribes()->count() }}
                                        </div>
                                        <span class="utility-muted">Subscribers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                $.post('/subscribes/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'subscribe') {
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消訂閱');
                    } else {
                        $this.addClass('btn-default').removeClass('btn-danger').text('訂閱');
                    }
                });
            });
        });
    </script>
@endsection