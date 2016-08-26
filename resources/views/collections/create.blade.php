
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Collection</h1>
        <form action="{{ route('collections.store') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection