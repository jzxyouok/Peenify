
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Product</h1>
        <form action="{{ route('products.store') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">產品名稱</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">產品描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..." class="form-control"></textarea>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="name">產品網址</label>--}}
                {{--<input type="text" name="site" class="form-control">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="name">產品封面</label>--}}
                {{--<input type="file" name="cover" class="form-control">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="name">Tags</label>--}}
                {{--<input type="text" name="tags" class="form-control">--}}
            {{--</div>--}}
            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection