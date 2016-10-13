@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 style="border-bottom: 1px solid #000000; display: inline-block">{{ $category->name }}</h1>
        </div>
        <p class="text-center">{{ $category->description }}</p>

        <div class="row">
            <img style="max-width: 100%; display: block; margin: 0 auto;"
                 src="{{ ($category->cover) ? image_path('categories', $category->cover):'holder.js/800x300' }}">
        </div>


        @include('categories._partials.products', [
                    'products' => $category->products,
                    ])
    </div>

@endsection