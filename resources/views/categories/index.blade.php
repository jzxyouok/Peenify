@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Categories</h1>
        @foreach($categories as $category)
            <h3><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h3>

            @include('_partials.follows', [
'type' => 'category',
'id' => $category->id,
])
            <p>{{ $category->description }}</p>
            <p>{{ $category->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection