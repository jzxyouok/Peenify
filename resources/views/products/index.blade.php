@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    最新產品
                </h2>
            </div>
        </div>

        <!--search bar-->
        <div class="row Searchbar__distance">
            @include('searches._partials.productbar')
        </div>

        <!--products-->
        @include('products._partials.products', [
            'products' => $products
        ])

        <div class="text-center">
            {!! $products->links('vendor.pagination.simple-default') !!}
        </div>

    </div>
@endsection