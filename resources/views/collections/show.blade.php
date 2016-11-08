@extends('layouts.app')

@section('content')
    <div class="container">
        @if (auth()->check())
            @if ($collection->owns())
                <div style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="text-right">
                            <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">Edit</a>
                            <a class="btn btn-default"
                               href="{{ route('collections.confirm.destroy', $collection->id) }}">Delete</a>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <!--收藏集介紹-->
        @include('collections._partials.part', [
            'collection' => $collection
        ])

        <!--使用者簡介-->
        @include('collections._partials.user', [
            'collection' => $collection
        ])

        <!--搜尋列-->
        @if ($collection->owns())
            <div class="row" style="margin:20px 20px">
                <!--搜尋要加入到收藏集的產品-->
                @include('searches.collection.productbar', [
                    'collection' => $collection,
                    'term' => ''
                ])
            </div>
        @endif

        <!--產品列表-->
        @include('collections._partials.products', [
        'products' => $collection->paginateProducts()
        ])
    </div>
@endsection