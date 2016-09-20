@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>所有產品</h1>
        @foreach($products as $product)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img class="image-size" src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/800x600' }}">
                    <h3 class="panel-title">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                </div>
                <div class="panel-body">
                    {{ str_limit($product->description) }}
                </div>

                <div class="panel-footer">
                    @include('products._partials.tags', [
                        '$product' => $product
                    ])
                    {{ $product->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('style')
    <style>
        #tag-link {
            color: #FFFFFF;
            text-decoration: none;
        }
    </style>
    @endsection