@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>跟隨者</h2>
        @foreach($subscribers as $subscriber)
            <a href="{{ route('users.show', $subscriber->id) }}">{{ $subscriber->name }}</a>
        @endforeach

        {!! $subscribers->links() !!}
    </div>
@endsection