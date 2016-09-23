@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>所有產品</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>產品名稱</td>
                <td>標籤</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product->id }}
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td>
                        @include('products._partials.tags', [
                             '$product' => $product
                        ])
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('products.edit', $product->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('products._partials.destroy', [
                         'product' => $product
                        ])
                    </td>
                    <td>
                        {{ $product->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $products->links() !!}</div>
@endsection