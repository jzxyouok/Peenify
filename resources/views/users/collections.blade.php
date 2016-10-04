@extends('layouts.app')

@section('content')

    @foreach($collections as $collection)
    <span>{{ $collection->name }}</span>
    @endforeach
@endsection