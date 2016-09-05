@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Actors</h1>
        @foreach($actors as $actor)
            <p>{{ $actor->name }}</p>
            <p>{{ $actor->description }}</p>
        @endforeach
    </div>

@endsection