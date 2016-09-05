@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Vendor</h1>
        <form action="{{ route('vendors.store') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入類別描述..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                代理商：<input type="text" name="agent" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection