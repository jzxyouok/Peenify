@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $author->name }}</h1>
        <p>{{ $author->description }}</p>
        <img class="image-size" src="{{ ($author->avatar) ? image_path('avatars.authors', $author->avatar):'holder.js/300x300' }}">
        <p>{{ $author->gender }}</p>
        <p>{{ $author->country }}</p>



        <a class="btn btn-default" href="{{ route('authors.edit', $author->id) }}">Edit</a>

        <form action="{{ route('authors.destroy', $author->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <!-- user -->
    </div>

@endsection