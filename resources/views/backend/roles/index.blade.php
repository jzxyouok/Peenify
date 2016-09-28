@extends('backend.layouts.app')

@section('content')

    <div class="container">
        <h1>All Role</h1>
        @foreach($roles as $role)
            <p>{{ $role->name }}</p>
            <p>{{ $role->label }}</p>
        @endforeach
    </div>

@endsection