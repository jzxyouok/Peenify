@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($collection->owns())
            <div style="padding-bottom: 10px;">
                <div class="row">
                    <div class="text-right">
                        <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">Edit</a>
                        <a class="btn btn-default" href="{{ route('collections.confirm.destroy', $collection->id) }}">Delete</a>
                    </div>
                </div>
            </div>
        @endif

            <!--收藏集介紹-->
            @include('collections._partials.part', [
                'collection' => $collection
            ])

            <!--使用者簡介-->
            @include('collections._partials.user', [
                'collection' => $collection
            ])

            @if ($collection->owns())
                <div class="row" style="margin: 20px 20px">
                    <!--搜尋要加入到收藏集的產品-->
                    @include('searches.collection.productbar', [
                        'collection' => $collection
                    ])
                </div>
            @endif

        @include('collections._partials.products', [
            'products' => $products
        ])

    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/masonry-loader.js') }}"></script>
    <script src="{{ asset('/js/favorite.js') }}"></script>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
    <script src="{{ asset('/js/collection.js') }}"></script>
@endsection