@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $collection->name }}</h1>
        <p>{{ $collection->description }}</p>

        <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">Edit</a>

        <form action="{{ route('collections.destroy', $collection->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    </div>

@endsection