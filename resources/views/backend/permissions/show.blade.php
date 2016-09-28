@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $permission->name }}</h1>
        <p>{{ $permission->label }}</p>

        <a class="btn btn-default" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>

        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <!-- user -->
    </div>

@endsection