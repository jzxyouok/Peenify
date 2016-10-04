@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($emojis as $emoji)
            <h3>{{ $emoji->emojiable->name }}</h3>
            <p>{{ $emoji->type }}</p>
        @endforeach
    </div>
@endsection