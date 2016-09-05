@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Authors</h1>
        @foreach($authors as $author)
            <p>{{ $author->name }}</p>
            <p>{{ $author->description }}</p>
        @endforeach
    </div>

@endsection