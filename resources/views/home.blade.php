@extends('layouts.app')

@section('style')
    <style>
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .align-text {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="links align-text">
            <a href="{{ route('categories.create') }}">建立分類</a>
            <a href="{{ route('products.create') }}">建立產品</a>
            <a href="{{ route('collections.create') }}">建立收藏集</a>
            <a href="{{ route('authors.create') }}">建立作者</a>
            <a href="{{ route('actors.create') }}">建立演員</a>
            <a href="{{ route('vendors.create') }}">建立廠商</a>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">儀表板</div>

                    <div class="panel-body">
                        你已經登入了！
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
