@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $comment->name }}</h1>
        <p>{{ $comment->description }}</p>

        <a class="btn btn-default" href="{{ route('comments.edit', $comment->id) }}">Edit</a>

        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
        <!-- user -->
    </div>

@endsection