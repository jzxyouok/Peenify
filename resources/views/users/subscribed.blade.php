@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>正在跟隨你</h2>
            @foreach($subscribed as $subscribe)
            <a href="{{ route('users.show', $subscribe->id) }}">{{ $subscribe->name }}</a>
        @endforeach

        {!! $subscribed->links() !!}
    </div>
@endsection