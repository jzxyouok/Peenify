@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>所有收藏集</h1>
        @foreach($collections as $collection)
            <h3><a href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a></h3>
            <p>{{ $collection->description }}</p>
            <p>{{ $collection->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection