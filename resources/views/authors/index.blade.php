@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>所有作者/導演</h1>
        @foreach($authors as $author)
            <img class="image-size" src="{{ ($author->avatar) ? image_path('avatars.authors', $author->avatar):'holder.js/300x300' }}">
            <p>{{ $author->name }}</p>
            <p>{{ $author->description }}</p>
        @endforeach

        {!! $authors->links() !!}
    </div>

@endsection