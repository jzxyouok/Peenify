@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>訂閱清單</h2>
            @foreach($subscribed as $subscribe)
            <a href="{{ route('users.show', $subscribe->id) }}">{{ $subscribe->name }}</a>
        @endforeach
    </div>
@endsection