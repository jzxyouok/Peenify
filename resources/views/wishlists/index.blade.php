@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Wishlists</h1>
        @foreach($wishlists as $wishlist)
            <h3><a href="{{ route('wishlists.show', $wishlist->id) }}">{{ $wishlist->name }}</a></h3>
            <p>{{ $wishlist->description }}</p>
            <p>{{ $wishlist->created_at->diffForHumans() }}</p>
        @endforeach
    </div>

@endsection