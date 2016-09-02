@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($wishes as $wish)
            <h2>{{ $wish->product->name }}</h2>
            <h3>{{ $wish->created_at->diffForHumans() }}</h3>

            <form action="{{ route('wishes.destroy', $wish->product->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" value="remove" class="btn btn-danger">
            </form>
        @endforeach
    </div>
@endsection