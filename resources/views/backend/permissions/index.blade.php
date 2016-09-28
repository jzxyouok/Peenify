@extends('backend.layouts.app')

@section('content')

    <div class="container">
        <h1>All Permission</h1>
        @foreach($permissions as $permission)
            <p>{{ $permission->name }}</p>
            <p>{{ $permission->label }}</p>
        @endforeach
    </div>

@endsection