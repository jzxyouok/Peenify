@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Tags</h1>
        @foreach($tags as $tag)
            <div>{{ $tag->name }}</div>
        @endforeach
    </div>

@endsection