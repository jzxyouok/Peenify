@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Users</h1>
        @foreach($users as $user)
            <img class="image-size" src="{{ ($user->avatar) ? image_path('avatars.users', $user->avatar):'holder.js/300x300' }}">
            <h3><a href="#">{{ $user->name }}</a></h3>
            <p>{{ $user->description }}</p>
            <p>{{ $user->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection