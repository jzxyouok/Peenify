@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    {{ $category->name }}
                </h2>
            </div>
        </div>

        <p class="text-center">{{ $category->description }}</p>

        <hr>

        <!--僅秀出9個最新產品做 promote-->
        @include('products._partials.products', [
                    'products' => $category->products()->latest()->limit(9)->get(),
                    ])

        <div class="text-center" style="padding-bottom: 10px">
            <a class="btn btn-default" href="{{ route('categories.products', $category->id) }}">more</a>
        </div>

    </div>

@endsection