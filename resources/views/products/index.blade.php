@extends('layouts.app')

@section('style')
    <style>
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
    <div class="container">
        <div class="col-md-12 text-center">
            <h2 style="display: inline-block; padding-bottom: 6px; border-bottom: 4px solid rgb(0, 160, 233); letter-spacing: 4px;">
                最新產品
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                @foreach($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="panel panel-default">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img style="max-width: 100%;"
                                     src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/348x261' }}">
                            </a>

                            <div class="panel-title">
                                <div class="Card__details">
                                    <h3 class="Card__title">
                                        <a href="{{ route('products.show', $product->id) }}"
                                           class="link_style">{{ str_limit($product->name, 20) }}
                                        </a>
                                    </h3>
                                    <div class="Card__count">
                                        {{ $product->emojis()->count() }}
                                        <span class="utility-muted">Rating</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="text-align: center">
            {!! $products->links() !!}
        </div>

    </div>
@endsection