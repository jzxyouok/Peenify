@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>所有產品</h1>
        @foreach($products as $product)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{ route('products.show', $product->id) }}">
                            {{ $product->name }}
                        </a>

                        @include('products._partials.tags', [
                                 '$product' => $product
                        ])
                    </h3>
                </div>

                <a class="btn btn-default" href="{{ route('products.edit', $product->id) }}">編輯</a>

                @include('products._partials.destroy', [
                     'product' => $product
                ])

                <div class="panel-footer">
                    {{ $product->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>
@endsection