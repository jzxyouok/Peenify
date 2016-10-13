@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 text-center" style="padding-bottom: 40px">
            <h2 style="display: inline-block; padding-bottom: 6px; border-bottom: 2px solid #000000; letter-spacing: 4px;">
                作者/導演
            </h2>
        </div>

        <div class="row">
            @foreach($authors as $author)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="panel panel-default">
                        <img class="img-responsive"
                             src="{{ ($author->avatar) ? image_path('avatars.authors', $author->avatar):'holder.js/360x360' }}">

                        <div class="panel-title">
                            <div class="Card__details">
                                <h3 class="Card__title">
                                    {{ $author->name }}
                                </h3>

                                <div class="Card__count">
                                    {{ $author->products()->count() }}
                                    <span class="utility-muted">artworks</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="text-align: center">
            {!! $authors->links() !!}
        </div>
    </div>


@endsection