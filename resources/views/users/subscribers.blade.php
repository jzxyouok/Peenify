@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>訂閱你的人</h2>
            @foreach($subscribers as $subscriber)
            <a href="{{ route('users.show', $subscriber->id) }}">{{ $subscriber->name }}</a>
        @endforeach
    </div>
@endsection