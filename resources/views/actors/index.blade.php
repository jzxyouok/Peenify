@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>所有演員</h1>
        @foreach($actors as $actor)
            <img class="image-size" src="{{ ($actor->avatar) ? image_path('avatars.actors', $actor->avatar):'holder.js/300x300' }}">
            <p>{{ $actor->name }}</p>
            <p>{{ $actor->description }}</p>
        @endforeach

        {!! $actors->links() !!}
    </div>

@endsection