@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $vendor->name }}</h1>
        <p>{{ $vendor->description }}</p>
        <p>{{ $vendor->agent }}</p>

        <a class="btn btn-default" href="{{ route('vendors.edit', $vendor->id) }}">Edit</a>

        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <!-- user -->
    </div>

@endsection