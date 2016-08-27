@extends('layouts.app')

@section('content')

    <div class="container">
        <img src="{{ !$user->avatar ?: image_path('avatars.user', $user->id, $user->avatar) }}">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->description }}</p>

        <a class="btn btn-default" href="{{ route('users.edit') }}">Edit</a>
    </div>

@endsection