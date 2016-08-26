@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Comments</h1>
        @foreach($comments as $comment)
            <h3><a href="{{ route('comments.show', $comment->id) }}">{{ $comment->name }}</a></h3>
            <p>{{ $comment->description }}</p>
            <p>{{ $comment->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection