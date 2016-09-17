@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>建立演員</h1>
        <form action="{{ route('actors.store') }}" method="post" role="form" enctype="multipart/form-data">
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
                <label for="name">頭像</label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <input type="radio" name="gender" value="male"> 男 <br />
                <input type="radio" name="gender" value="female"> 女 <br />
            </div>
            <div class="form-group">
                國家：<input type="text" name="country" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection