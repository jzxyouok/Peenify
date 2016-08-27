@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->description }}</p>

        <a class="btn btn-default" href="#">Edit</a>
    </div>

@endsection