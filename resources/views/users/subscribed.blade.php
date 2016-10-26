@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    正在訂閱
                </h2>
            </div>
        </div>

        <div class="row">
            @foreach($subscribed as $subscribe)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel">
                        <div class="Card__detail">
                            <h3 class="Card__title">
                                <img class="round"
                                     src="{{ ($subscribe->avatar) ? image_path('avatars.users', $subscribe->avatar):'holder.js/50x50' }}">
                                <a href="{{ route('users.show', $subscribe->id) }}">{{ $subscribe->name }}</a>
                            </h3>
                        </div>

                        <div>
                            {{ $subscribe->description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $subscribed->links() !!}
        </div>
    </div>
@endsection