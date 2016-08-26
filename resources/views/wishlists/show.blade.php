@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $wishlist->name }}</h1>
        <p>{{ $wishlist->description }}</p>

        <a class="btn btn-default" href="{{ route('wishlists.edit', $wishlist->id) }}">Edit</a>

        <form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    </div>

@endsection