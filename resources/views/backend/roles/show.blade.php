@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $role->name }}</h1>
        <p>{{ $role->label }}</p>

        <a class="btn btn-default" href="{{ route('roles.edit', $role->id) }}">Edit</a>

        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <!-- user -->
    </div>

@endsection