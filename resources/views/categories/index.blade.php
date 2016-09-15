@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Categories</h1>
        @foreach($categories as $category)
            <img src="{{ ($category->cover) ? image_path('category', $category->cover):'holder.js/800x600' }}">
            <h3><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h3>

            @include('_partials.follows', [
            'relation' => $category,
            'type' => 'category',
            ])

            <p>{{ $category->description }}</p>
            <p>{{ $category->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection