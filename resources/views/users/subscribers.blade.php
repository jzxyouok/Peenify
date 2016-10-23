@extends('layouts.app')

@section('style')
    <style>
        .round {
            border-radius: 50%;
            overflow: hidden;
            width: 50px;
            height: 50px;
        }

        .round img {
            display: block;
            min-width: 100%;
            min-height: 100%;
        }

        .Card__image {
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            height: auto;
        }

        .description {
            margin: 0 auto;
            display: inline-block;
            max-width: 500px;
            padding: 0.5em 0.5em;
            text-align: justify;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <h2>跟隨者</h2>
        <div class="row">
            @foreach($subscribers as $subscriber)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4" style="border: 1px solid #ccc;padding :10px 10px;">
                    <div style="padding-top: 20px">
                        <img src="{{ ($subscriber->avatar) ? image_path('avatars.users', $subscriber->avatar):'holder.js/50x50' }}">
                        <div>
                            <a href="{{ route('users.show', $subscriber->id) }}">{{ $subscriber->name }}</a>
                            <p>{{ $subscriber->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $subscribers->links() !!}
    </div>
@endsection