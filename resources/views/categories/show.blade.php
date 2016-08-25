@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        <a class="btn btn-default" href="{{ route('categories.edit', $category->id) }}">Edit</a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
        <!-- user -->
    </div>

@endsection