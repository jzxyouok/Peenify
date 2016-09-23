@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>標籤雲</h1>
        @foreach($tags as $tag)
            <div class="label label-default"><a style="text-decoration: none;color: #FFFFFF;" href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></div>
        @endforeach
    </div>

@endsection