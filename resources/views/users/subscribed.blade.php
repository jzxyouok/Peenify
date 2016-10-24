@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>正在訂閱</h2>
        <div class="row">
            @foreach($subscribed as $subscribe)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img class="round" src="{{ ($subscribe->avatar) ? image_path('avatars.users', $subscribe->avatar):'holder.js/50x50' }}">
                            <a href="{{ route('users.show', $subscribe->id) }}">{{ $subscribe->name }}</a>
                            <p>{{ $subscribe->description }}</p>
                        </div>
                    </div>
                </div>

            @endforeach

            {!! $subscribed->links() !!}
        </div>
@endsection