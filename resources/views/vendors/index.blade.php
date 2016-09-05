@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>All Vendors</h1>
        @foreach($vendors as $vendor)
            <p>{{ $vendor->name }}</p>
            <p>{{ $vendor->description }}</p>
            <p>{{ $vendor->agent }}</p>
        @endforeach
    </div>

@endsection