@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($follows as $follow)
            <h3>{{ $follow->followable->name }}</h3>
            <p>{{ $follow->user->name }}</p>
        @endforeach
    </div>
@endsection