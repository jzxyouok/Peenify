@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>所有產品</h1>
        @foreach($products as $product)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $product->description }}
                </div>

                <div class="panel-footer">
                    {{ $product->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>
@endsection