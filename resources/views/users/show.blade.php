@extends('layouts.app')

@section('content')

    <div class="container">
        <img src="{{ !$user->avatar ?: image_path('avatar.user', $user->id, $user->avatar) }}">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->description }}</p>

        <a class="btn btn-default" href="{{ route('users.edit') }}">Edit</a>
    </div>

    @include('comments._partials.create', [
    'commentable_type' => 'user',
    'commentable_id' => $user->id,
])

    @include('comments._partials.show', [
        'comments' => $user->comments
    ])
@endsection