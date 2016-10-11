@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>所有收藏集</h1>
        <div class="row">
            <div class="col-md-12">
                @foreach($collections as $collection)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="panel panel-default">
                            <a href="{{ route('collections.show', $collection->id) }}">
                                <img style="max-width: 100%;"
                                     src="holder.js/348x261">
                            </a>

                            <div class="panel-title">
                                <div class="Card__details">
                                    <h3 class="Card__title">
                                        <a class="link_style"
                                           href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                                    </h3>
                                </div>
                                <div class="Card__details">
                                    <div class="Card__title">
                                        {{ $collection->description }}
                                    </div>

                                    <div class="Card__count">
                                        {{ $collection->products()->count() }}
                                        <span class="utility-muted">total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style="text-align: center">
        {!! $collections->links() !!}
    </div>

@endsection