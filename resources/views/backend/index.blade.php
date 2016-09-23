@extends('backend.layouts.app')

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
            <a href="{{ route('categories.create') }}">分類</a>
            <a href="{{ route('collections.create') }}">收藏集</a>
            <a href="{{ route('authors.create') }}">作者</a>
            <a href="{{ route('actors.create') }}">演員</a>
            <a href="{{ route('vendors.create') }}">廠商</a>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">儀表板</div>

                    <div class="panel-body">
                        歡迎來到後台
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection