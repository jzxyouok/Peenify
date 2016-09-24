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