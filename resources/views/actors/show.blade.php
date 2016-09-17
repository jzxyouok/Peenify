@extends('layouts.app')

@section('content')

    <div class="container">
        <img class="image-size" src="{{ ($actor->avatar) ? image_path('avatars.actors', $actor->avatar):'holder.js/300x300' }}">
        <h1>{{ $actor->name }}</h1>
        <p>{{ $actor->description }}</p>
        <p>{{ $actor->gender }}</p>
        <p>{{ $actor->country }}</p>

        <a class="btn btn-default" href="{{ route('actors.edit', $actor->id) }}">Edit</a>

        <form action="{{ route('actors.destroy', $actor->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <!-- user -->
    </div>

@endsection