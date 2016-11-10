@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    @if ($products->isEmpty())
                        Oops! 目前還沒有資料...:(
                    @else
                        {{ $products[0]->category->name }}'s Products
                    @endif
                </h2>
            </div>
        </div>

        <hr style="max-width: 500px">

        @if ($products->isEmpty())
            @include('products._partials.products', [
                        'products' => $products,
                        ])

            <div class="text-center">
                {!! $products->links('vendor.pagination.simple-default') !!}
            </div>
        @endif
    </div>
@endsection