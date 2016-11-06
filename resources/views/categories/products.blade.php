@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    {{ $products[0]->category->name }}'s Products
                </h2>
            </div>
        </div>

        <hr>

        @include('products._partials.products', [
                    'products' => $products,
                    ])

        <div class="text-center">
            {!! $products->links('vendor.pagination.simple-default') !!}
        </div>

    </div>

@endsection